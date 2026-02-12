<?php
$current_navi_item = "about";
$page_title = "About - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
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
                <h2>Lorem</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. </p>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </section>

            <section class="content-section">
                <h2>Ipsum</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <ul>
                    <li><strong>Lorem Ipsum</strong> - Dolor sit amet consectetur</li>
                    <li><strong>Adipiscing Elit</strong> - Sed do eiusmod tempor</li>
                    <li><strong>Incididunt</strong> - Ut labore et dolore magna</li>
                    <li><strong>Aliqua</strong> - Ut enim ad minim veniam</li>
                </ul>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>

    <!-- Main JavaScript - with CSP nonce -->
    <script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>
</body>
</html>