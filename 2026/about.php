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
                <h2>About this site</h2>
                <p>This website is my personal portfolio and "project" site where you can find information about my work, projects, and interests.</p>
                <p>Mind you, this is a work in progress and not all content is fully implemented yet.</p>
            </section>

            <section class="content-section">
                <h2>About Me</h2>
                <p>I'm a first(1st) year student in Information Technology at the University of Applied Sciences of Oulu. A simple minded workaholic, jack-of-all-trades cybersecurity enjoyer.</p>
                <ul>
                    <li><strong>Programming</strong> - PHP, JavaScript, HMTL, CSS, C, C++, and a tiny bit of C#.</li>
                    <li><strong>Design</strong> - UI/UX design, responsive layouts, and accessibility.</li>
                    <li><strong>Database</strong> - MySQL, PostreSQL, MariaDB</li>
                    <li><strong>Other</strong> - Git, Linux, Docker, and some basic devops practices.</li>
                </ul>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>

    <!-- Main JavaScript - with CSP nonce -->
    <script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>
</body>
</html>