<?php
$current_navi_item = "home";
$page_title = "Home - " . (defined("SITE_NAME") ? SITE_NAME : "My Website");
$is_frontpage = true;
?>
<!DOCTYPE html>
<html lang="en">

<?php include __DIR__ . "/inc/head.inc.php"; ?>

<body class="homepage">
    <?php include __DIR__ . "/inc/navigation.inc.php"; ?>

    <?php include __DIR__ . "/inc/header.inc.php"; ?>

    <main class="main-content">
        <div class="container">

            <!-- Hero Section -->
             <section class="hero-section">
                <div class="hero-content">
                    <h2>Build something amazing</h2>
                    <p>This is a clean, component-based website built with php, inspired by the Disobey architecture.</p>
                    <a href="<?php echo $baseurl; ?>about" class="btn-primary">Learn More</a>
                </div>
             </section>

            <!-- Features Section -->
             <section class="features-section">
                <h2>Features</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>Clean URLs</h3>
                        <p>Uses a PHP router for beautiful, SEO-friendly URLs.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Component-Based</h3>
                        <p>Reusable PHP includes keep your code DRY</p>
                    </div>
                    <div class="feature-card">
                        <h3>No Build Process</h3>
                        <p>Pure PHP - no webpack, no npm, just code</p>
                    </div>
                    <div class="feature-card">
                        <h3>Easy Deployment</h3>
                        <p>Works on any PHP hosting platform</p>
                    </div>
                </div>
             </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>

</body>
</html>