<footer class="footer">
    <div class="container">
        <!-- Assuming some footer content might be here -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> IT Duck. All rights reserved.</p>
            <div class="theme-switcher">
                 <button id="theme-toggle" aria-label="Toggle theme">
                    <!-- Icons can be adjusted as needed -->
                 </button>
            </div>
        </div>
    </div>
</footer>

<!-- Main JavaScript file -->
<script nonce="<?php echo $csp_nonce; ?>" src="<?php echo htmlspecialchars($baseurl); ?>js/main.js"></script>

<!-- Inline script for theme TOGGLE logic - CORRECTED and WITH NONCE -->
<script nonce="<?php echo $csp_nonce; ?>">
    (function() {
        const themeToggle = document.getElementById('theme-toggle');
        
        // This function handles the button click
        function handleThemeToggle() {
            // Check if the light-mode class is currently present
            const isLight = document.documentElement.classList.contains('light-mode');
            
            if (isLight) {
                // If it's light, switch to dark
                document.documentElement.classList.remove('light-mode');
                localStorage.setItem('theme', 'dark');
            } else {
                // If it's dark, switch to light
                document.documentElement.classList.add('light-mode');
                localStorage.setItem('theme', 'light');
            }
        }

        // Add the click event listener to the button
        if(themeToggle) {
            themeToggle.addEventListener('click', handleThemeToggle);
        }
    })();
</script>