<?php
$current_navi_item = "contact";
$page_title = "Contact - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
$header_title = "Get In Touch";
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
                <p>Email: <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a></p>
            </section>

            <section class="content-section">
                <h2>Send me a message</h2>
                <form class="contact-form" method="post" action="">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>
</body>
</html>