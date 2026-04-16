<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php echo defined('SITE_NAME') ? SITE_NAME : 'IT Duck'; ?></h3>
                <p>Official website of <?php echo defined('SITE_NAME') ? SITE_NAME : 'IT Duck'; ?></p>
            </div>

            <div class="footer-section">
                <h3>Quick links</h3>
                <ul>
                    <li><a href="<?php echo htmlspecialchars($baseurl); ?>">Home</a></li>
                    <li><a href="<?php echo htmlspecialchars($baseurl); ?>about">About</a></li>
                    <li><a href="<?php echo htmlspecialchars($baseurl); ?>contact">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Connect</h3>
                <p>Email: <?php echo defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'contact@example.com'; ?></p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> <?php echo defined('SITE_NAME') ? SITE_NAME : 'IT Duck'; ?>. All rights reserved.</p>
            
            <!-- Restored Theme Switcher Button -->
            <div class="theme-switcher">
                <button id="theme-toggle" aria-label="Toggle theme">
                    <!-- Your icons for light/dark mode go here -->
                </button>
            </div>
        </div>
    </div>
</footer>

<!-- Main JavaScript file -->
<script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>

<!-- Inline script for theme toggle logic - Nonced and Corrected -->
<script nonce="<?php echo $csp_nonce; ?>">
    (function() {
        const themeToggle = document.getElementById('theme-toggle');
        
        function handleThemeToggle() {
            const isLight = document.documentElement.classList.contains('light-mode');
            
            if (isLight) {
                document.documentElement.classList.remove('light-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.add('light-mode');
                localStorage.setItem('theme', 'light');
            }
        }

        if(themeToggle) {
            themeToggle.addEventListener('click', handleThemeToggle);
        }
    })();
</script>