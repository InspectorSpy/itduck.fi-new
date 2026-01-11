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
                    <h2>Lorem Ipsum Dolor</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    <a href="<?php echo $baseurl; ?>about" class="btn-primary">Irure dolor</a>
                </div>
             </section>

            <!-- Features Section -->
             <section class="features-section">
                <h2>Features</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <h3>Lorem Ipsum</h3>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Lorem Ipsum</h3>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Lorem Ipsum</h3>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Lorem Ipsum</h3>
                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    </div>
                </div>
             </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>

</body>
</html>