<?php
$current_navi_item = "about";
$page_title = "About - " . (defined("SITE_NAME") ? SITE_NAME : "My Website");
$header_title = "About Us";
?>

<!DOCTYPE html>
<html lang="en">

<?php include __DIR__ . "/inc/head.inc.php"; ?>

<body class="about-page">
    
    <?php include __DIR__ . "/inc/navigation.inc.php"; ?>

    <?php include __DIR__ . "/inc/header.inc.php"; ?>

    <main class="main-content">
        <div class="container">

            <section class="content-section">
                <h2>Our Story</h2>
                <p>This website is built using simple but powerful PHP architecture, inspired by the Disobey conference website.</p>
                <p>We believe in keeping things simple and maintainable. No complex frameworks, no overwhelming build processes - just clean, organized PHP code.</p>
            </section>

            <section class="content-section">
                <h2>Technology Stack</h2>
                <ul>
                    <li><strong>PHP</strong> - Server-side rendering</li>
                    <li><strong>Component Architecture</strong> - Reusable includes</li>
                    <li><strong>Clean URLs</strong> - Custom router</li>
                    <li><strong>Vanilla JS</strong> - No heavy frameworks</li>
                </ul>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>
</body>
</html>