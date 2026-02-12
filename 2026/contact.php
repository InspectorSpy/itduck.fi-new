<?php
$current_navi_item = "contact";
$page_title = "Contact - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
$header_title = "Get In Touch";

$success_message ="";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validate inputs
    $name = htmlspecialchars(trim($_POST["name"] ?? ""), ENT_QUOTES, 'UTF-8');
    $email = trim($_POST["email"] ?? "");
    $message = htmlspecialchars(trim($_POST["message"] ?? ""), ENT_QUOTES, 'UTF-8');

    if (!empty($name) && !empty($email) && !empty($message)) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Create data directory if it doesn't exist
            $data_dir = __DIR__ . "/data";
            if (!file_exists($data_dir)) {
                mkdir($data_dir, 0755, true);
            }

            // Prepare message data
            $message_data = [
                "timestamp" => date("Y-m-d H:i:s"),
                "name"=> $name,
                "email"=> htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
                "message"=> $message
            ];

            // Load existing messages
            $message_file = $data_dir . "/messages.json";
            $messages = [];

            if (file_exists($message_file)) {
                $messages = json_decode(file_get_contents($message_file), true) ?? [];
            }

            // Add new message
            $messages[] = $message_data;

            // Save to file
            $json_data = json_encode($messages, JSON_PRETTY_PRINT);

            if (file_put_contents($message_file, $json_data)) {
                $success_message = "Thank you! Your message has been sent successfully.";
            } else {
                $error_message = "Sorry, there was an error saving your message, Please try again.";
            }
        } else {
            $error_message = "Please enter a valid email address.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include __DIR__ . "/inc/head.inc.php"; ?>

<body class="contact-page">

    <?php include __DIR__ . "/inc/navigation.inc.php"; ?>

    <?php include __DIR__ . "/inc/header.inc.php"; ?>

    <main class="main-content">
        <div class="container">      
            <section class="content-section">
                <h2>Contact Information</h2>
                <h1>NOTE: This contact form is currently non-functional.</h1>
                <p>Email: <a href="mailto:<?php echo htmlspecialchars(CONTACT_EMAIL); ?>"><?php echo htmlspecialchars(CONTACT_EMAIL); ?></a></p>
            </section>

            <section class="content-section">
                <h2>Send me a message</h2>
                <?php if ($success_message): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-error">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form class="contact-form" method="post" action="">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST["name"] ?? ""); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST["email"] ?? ""); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required><?php echo htmlspecialchars($_POST["message"] ?? ""); ?></textarea>
                    </div>

                    <button type="submit" class="btn-primary">Send Message</button>

                </form>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>
    
    <!-- Main JavaScript - with CSP nonce -->
    <script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>
</body>
</html>