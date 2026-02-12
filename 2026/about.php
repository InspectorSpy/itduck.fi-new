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

                <h3>Purpose & Goals</h3>
                <p>This website serves as my personal portfolio and project showcase, where I share and document my work, projects and interests. 
                    It's both a learning platform and a professional presence, allowing me to experiment with new technologies while sharing my work on the web.</p>

                <h3>Development journey</h3>
                <p>Built from the ashes of my old project website as a hands-on learning project, this site kind of reflects my growth as a developer. 
                    Every line of code has taught me something new, from implementing security features to creating responsive layouts that work across all devices.</p>

                <h3>Technical stack</h3>
                <p>This site is built with simplicity and security in mind. Technologies used include:</p>
                <ul>
                    <li><strong>Programming</strong> - PHP for server-side logic, JavaScript for interactivity, HTML and CSS for structure and styling.</li>
                    <li><strong>Security</strong> - Content Security Policy (CSP) with nonces, input sanitization, and XSS prevention measures.</li>
                    <li><strong>Design</strong> - Responsive UI/UX design, mobile-first approach, and accessibility considerations.</li>
                    <li><strong>Infrastructure</strong> - Hosted on a Debian server, version controlled with Git, following basic DevOps practices.</li>
                </ul>

                <h3>Architecture & Features</h3>
                <p>The site follows a modular PHP architecture with reusable components (navigation, header, footer) for maintainability. Key features include:</p>
                <ul>
                    <li>Clean, semantic HTML5 structure</li>
                    <li>Security-hardened with CSP headers and input validation</li>
                    <li>Responsive design that adapts to any screen size</li>
                    <li>Lightweight and performance-optimized</li>
                </ul>

                <h3>Future plans</h3>
                <p>I'm constantly (read when motivated) working on improvements and new features. Upcoming additions may include:</p>
                <ul>
                    <li>Detailed project case studies and write-ups</li>
                    <li>Enhanced interactivity and dynamic content</li>
                    <li>Enhanced accessibility features (WCAG compliance?)</li>
                    <li>Performance optimizations and caching strategies</li>
                    <li>Working contact form</li>
                </ul>
                
                <h3>Open Source & Learning</h3>
                <p>This project is <a href="https://github.com/InspectorSpy/itduck.fi-new" target="_blank" rel="noopener noreferrer">open source on GitHub</a>, 
                where you can explore the code, track progress and see how everything works under the hood. Feel free to check it out if you're curious about the implementation details.</p>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/inc/footer.inc.php"; ?>

    <!-- Main JavaScript - with CSP nonce -->
    <script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>
</body>
</html>