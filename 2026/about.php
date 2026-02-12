<?php
$current_navi_item = "about";
$page_title = "About - " . (defined("SITE_NAME") ? SITE_NAME : "IT Duck");
$header_title = "About";
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
                <h2>About me</h2>
                <p>I'm a first year student in Information Technology at the Oulu University of Applied Sciences. A simple-minded workaholic, jack-of-all-trades cybersecurity enjoyer.</p>
            </section>

            <section class="content-section">
                <h2>About this site</h2>
                <p>This website is my personal portfolio and "project" site where you can find information about my work, projects, and interests.</p>
                <p>Mind you, this is a work in progress and not all content is fully implemented yet.</p>
                <p>Technologies used in this site include:</p>
                <ul>
                    <li><strong>Programming</strong> - PHP, JavaScript, HTML, CSS.</li>
                    <li><strong>Design</strong> - UI/UX design, responsive layouts, and accessibility.</li>
                    <li><strong>Other</strong> - Git, Debian, and some basic devops practices.</li>
                </ul>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>

    <!-- Main JavaScript - with CSP nonce -->
    <script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>
</body>
</html>