<?php
$current_navi_item = "projects";
$page_title = "Projects - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
$vite_entry = "src/projects/main.jsx";

if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/inc/config.php';
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
                <h1>Projects</h1>
                <div id="root"></div>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>
</body>

</html>
