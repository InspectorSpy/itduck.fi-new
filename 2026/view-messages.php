<?php
// This is not a secure method!! Just a simple password protection for viewing messages.
session_start();
if (!isset($_SESSION["authenticated"])) {
    if (isset($_POST["password"]) && $_POST["password"] === "notsecure") {
        $_SESSION["authenticated"] = true;
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <body style="background: #1c1d28; color: #e1bd2e; font-family: sans-serif; padding: 50px; text-align: center;">
                <h2>Enter password</h2>
                <form method="post">
                    <input type="password" name="password" style="padding: 10px; font-size: 16px;">
                    <button type="submit" style="padding: 10px 20px; font-size: 16px;">Login</button>
            </form>
            </body>
        </html>
        <?php
        exit;
    }
}

// Simple messages viewer
require_once __dir__ . "/inc/config.php";

$messages_file = __dir__ . "/data/messages.json";
$messages = [];

if (file_exists($messages_file)) {
    $messages = json_decode(file_get_contents($messages_file), true) ?? [];
}

// Reverse to show newest first
$messages = array_reverse($messages);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include __DIR__ . "/inc/head.inc.php"; ?>

    <body>
        <div class="container" style="padding: 40px 20px;">
            <h1>Contact messages (<?php echo count($messages); ?>)</h1>

            <?php if (empty($messages)): ?>
                <p>No messages yet. </p>
            <?php else:  ?>
                <?php foreach ($messages as $msg): ?>
                    <div style="background: var(--bg-secondary); padding: 20px; margin: 20px 0; border-radius: 8px; border-left: 4px solid var(--yellow);">
                        <p><strong>From: </strong> <?php echo htmlspecialchars($msg["name"]); ?></p>
                        <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($msg["email"]); ?>"><?php echo htmlspecialchars($msg["email"]); ?></a></p>
                        <p><strong>Date:</strong> <?php echo htmlspecialchars($msg["timestamp"]); ?></p>
                        <p><strong>Message:</strong></p>
                        <p><?php echo nl2br(htmlspecialchars($msg["message"])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Main JavaScript - with CSP nonce -->
         <script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>
    </body>
</html>