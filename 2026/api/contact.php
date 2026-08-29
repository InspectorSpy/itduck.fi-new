<?php
// JSON API endpoint replacing the old inline POST handling in contact.php.
// - Accepts POST only, JSON body { name, email, message }
// - CSRF via X-CSRF-Token header (token embedded in contact.php's #root
//   data-csrf attribute), not a form field, since this is a fetch() call
// - Rate limit: max 5 submissions/hour, session-based (same policy as
//   before, still worth revisiting per F6, session-based limiting is weak
//   against bots that don't retain cookies)
// - Uses CF-Connecting-IP for logging (trustworthy now that the origin
//   firewall only accepts 443 from Cloudflare's ranges, see F1)
// - Sends via Proton SMTP (PHPMailer), contact@itduck.fi to itself
// - Returns JSON: { success: true } or { success: false, error: "..." }

require_once __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');
header('Cache-Control: no-store');

// Helper to respond with JSON and exit
function respond(bool $success, string $error = ''): void {
    echo json_encode($success ? ['success' => true] : ['success' => false, 'error' => $error]);
    exit;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    respond(false, 'Method not allowed.');
}

// CSRF check: token comes via header, not a form field, since this is JSON
$sent_token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $sent_token)) {
    http_response_code(403);
    respond(false, 'Invalid request. Please refresh the page and try again.');
}

// Client IP: CF-Connecting-IP is trustworthy because the origin firewall
// (both v4 and v6) only accepts 443 traffic from Cloudflare's ranges.
$ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];

// Rate limiting, max 5 submissions per hour per session. Kind of weak against bots.
$max_submissions = 5;
$time_window = 3600;
$current_time = time();

// Init the session array if it doesn't exist yet
if (!isset($_SESSION['form_submissions'])) {
    $_SESSION['form_submissions'] = [];
}

// Remove timestamps older than the time window
$_SESSION['form_submissions'] = array_filter(
    $_SESSION['form_submissions'],
    fn($t) => ($current_time - $t) < $time_window
);

// Check if the user has exceeded the max submissions
if (count($_SESSION['form_submissions']) >= $max_submissions) {
    http_response_code(429);
    respond(false, 'You have submitted the form too many times. Please try again later.');
}

// Read and validate the JSON body
$body = json_decode(file_get_contents('php://input'), true);
$name = trim($body['name'] ?? '');
$email = trim($body['email'] ?? '');
$message = trim($body['message'] ?? '');

// Validate input
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'Please enter a valid email address.');
}
if (empty($name) || empty($message)) {
    respond(false, 'Please fill out all fields.');
}

// Record submission attempt (counts towards rate limit even if write fails below)
$_SESSION['form_submissions'][] = $current_time;

// Send email via Proton SMTP using PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'] ?? 'smtp.protonmail.ch';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_TOKEN'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($_ENV['SMTP_USER'], 'itduck.fi Contact Form');
    $mail->addAddress($_ENV['SMTP_USER']); // Send to itself
    $mail->addReplyTo($email, $name);

    $mail->Subject = "New contact form message from {$name}";
    $mail->Body = "From: {$name} <{$email}>\nIP: {$ip_address}\nTime: " . date('Y-m-d H:i:s') . "\n\nMessage:\n{$message}";

    $mail->send();
} catch (Exception $e) {
    error_log("Contact form mail failed: {$mail->ErrorInfo}");
    http_response_code(500);
    respond(false, 'Something went wrong sending your message. Please try again later.');
}

// Rotate CSRF token after successful user
unset($_SESSION['csrf_token']);

respond(true);
