<?php
$current_navi_item = "contact";
$page_title = "Contact - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
$header_title = "Get In Touch";

$success_message ="";
$error_message = "";
$debug = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $debug .= "Form submitted. <br>";

    // Validate inputs
    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    $debug .= "Name: $name<br>Email: $email<br>Message: $message<br>";

    if (!empty($name) && !empty($email) && !empty($message)) {

        $debug .= "Fields are not empty<br>";

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $debug .= "Email is valid<br>";

            // Create data directory if it doesn't exist
            $data_dir = __DIR__ . "/data";
            if (!file_exists($data_dir)) {
                mkdir($data_dir, 0755, true);

                $debug .= "Data directory created<br>";
            }

            // Prepare message data
            $message_data = [
                "timestamp" => date("Y-m-d H:i:s"),
                "name"=> $name,
                "email"=> $email,
                "message"=> $message
            ];

            $debug .= "Message data: " . print_r($message_data, true) . "<br>";

            // Load existing messages
            $message_file = $data_dir . "/messages.json";
            $messages = [];

            if (file_exists($message_file)) {
                $messages = json_decode(file_get_contents($message_file), true) ?? [];
                $debug .= "Loaded " . count($messages) . " existing messages<br>"; 
            }

            // Add new message
            $messages[] = $message_data;
            $debug .= "Total messages now: " . count($messages) . "<br>";

            // Save to file
            $json_data = json_encode($messages, JSON_PRETTY_PRINT);
            $debug .= "JSON to save: <pre>" . htmlspecialchars($json_data) . "</pre><br>";

            if (file_put_contents($message_file, $json_data)) {
                $success_message = "Thank you! Your message has been sent successfully.";
                $debug .= "File saved successfully.<br>";
            } else {
                $error_message = "Sorry, there was an error saving your message, Please try again.";
                $debug .= "ERROR: Failed to save file.<br>";
            }
        } else {
            $error_message = "Please enter a valid email address.";
            $debug .= "Email validation failed.<br>";
        }
    } else {
        $error_message = "Please fill in all fields.";
        $debug .= "Empty fields detected<br>";
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

            <?php if ($debug): ?>
                <div style="background: #333; color: #0f0; padding: 15px; margin: 20px 0; border-radius: 5px; font-family: monospace; font-size: 12px;">
                    <strong>DEBUG OUTPUT:</strong><br>
                    <?php echo $debug; ?>
                </div>
            <?php endif; ?>
            
            <section class="content-section">
                <h2>Contact Information</h2>
                <p>Email: <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a></p>
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
</body>
</html>