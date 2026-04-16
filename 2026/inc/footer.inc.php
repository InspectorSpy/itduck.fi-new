<footer class="site-footer">
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
            <p>Email: <?php echo defined('CONTACT_EMAIL') ? CONTACT_EMAIL : ''; ?></p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> <?php echo defined('SITE_NAME') ? SITE_NAME : 'IT Duck'; ?>. All rights reserved.</p>
        
        <!-- NEW: Theme switcher using text/emoji, no SVGs -->
        <div class="theme-switcher">
            <button id="theme-toggle" aria-label="Toggle theme">
                <span class="theme-icon-sun">☀️</span>
                <span class="theme-icon-moon">🌙</span>
            </button>
        </div>
    </div>
</footer>

<!-- Main JavaScript file -->
<script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>

<!-- Inline script for theme TOGGLE logic - CORRECTED and WITH NONCE -->
<script nonce="<?php echo $csp_nonce; ?>">
    (function() {
        const themeToggle = document.getElementById('theme-toggle');
        const sunIcon = document.querySelector('.theme-icon-sun');
        const moonIcon = document.querySelector('.theme-icon-moon');

        function updateButtonIcons() {
            const isLight = document.documentElement.classList.contains('light-mode');
            if (isLight) {
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'inline';
            } else {
                sunIcon.style.display = 'inline';
                moonIcon.style.display = 'none';
            }
        }

        function handleThemeToggle() {
            const isLight = document.documentElement.classList.contains('light-mode');
            if (isLight) {
                document.documentElement.classList.remove('light-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.add('light-mode');
                localStorage.setItem('theme', 'light');
            }
            updateButtonIcons(); // Update icons immediately on click
        }

        // Add the click event listener
        if(themeToggle) {
            themeToggle.addEventListener('click', handleThemeToggle);
        }

        // Set initial state of the button on page load
        updateButtonIcons();
    })();
</script>

<!-- Simple CSS to manage the theme switcher layout and icons -->
<style nonce="<?php echo $csp_nonce; ?>">
    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap; /* Allows wrapping on small screens */
    }
    .theme-switcher button {
        background: none;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        color: var(--text-color);
        cursor: pointer;
        padding: 8px;
        font-size: 1.2rem; /* Makes the emoji larger */
        line-height: 1;
    }
</style>