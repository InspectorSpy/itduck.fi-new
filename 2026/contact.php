<?php
$current_navi_item = "contact";
$page_title = "Contact - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
$vite_entry = "src/main.jsx"; //* Specify the Vite entry point for this page

// Ensure session is started for authentication
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/inc/config.php';
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

?>
<!DOCTYPE html>
<html lang="en">

<?php include __DIR__ . "/inc/head.inc.php"; ?>

<body>
    <?php include __DIR__ . "/inc/navigation.inc.php"; ?>

    <main class="main-content">
        <div class="container">
            <section class="content-section text-center">
                <h1>Contact me</h1>
                <p>Have a question in mind? Let's talk.</p>

                <div id="root" data-csrf="<?php echo htmlspecialchars($csrf_token); ?>"></div>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>
</body>

</html>
