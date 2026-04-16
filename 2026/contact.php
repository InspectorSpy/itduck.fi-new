<?php
$current_navi_item = "contact";
$page_title = "Contact - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");

// Ensure session is started for authentication
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/inc/config.php';
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$message_sent = false;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($csrf_token, $_POST['csrf_token'])) {
        $error_message = "Invalid request. Please try again.";
        // Invalidate the token to prevent reuse
        unset($_SESSION['csrf_token']);
    } else {
        // Process form data
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Please enter a valid email address.";
        } elseif (empty($name) || empty($message)) {
            $error_message = "Please fill out all fields.";
        } else {
            $messages_file = __DIR__ . '/data/messages.json';
            $messages = json_decode(file_get_contents($messages_file), true) ?? [];

            $new_message = [
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'timestamp' => date('Y-m-d H:i:s')
            ];

            $messages[] = $new_message;
            file_put_contents($messages_file, json_encode($messages, JSON_PRETTY_PRINT));
            
            $message_sent = true;

            // Unset token after successful use
            unset($_SESSION['csrf_token']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include __DIR__ . "/inc/head.inc.php"; ?>

<body>
    <?php include __DIR__ . "/inc/navigation.inc.php"; ?>

    <main class="main-content">
        <div class="container">
            <section class="content-section text-center">
                <h1>Contact Me</h1>
                <p>Have a question or a project in mind? Let's talk.</p>

                <?php if ($message_sent): ?>
                    <div class="alert alert-success">
                        Thank you for your message! I'll get back to you shortly.
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <?php if (!$message_sent): ?>
                <form action="<?php echo htmlspecialchars($baseurl); ?>contact" method="post" class="contact-form">
                    
                    <!-- Add hidden CSRF token field to the form  -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
                <?php endif; ?>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>
</body>
</html>