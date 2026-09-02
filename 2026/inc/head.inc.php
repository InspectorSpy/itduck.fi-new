<?php
// Initialize config if not already set
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/config.php';
}
// Enforce security headers immediately
require_once __DIR__ . '/security-headers.php';
//* Vite build helper, used only by pages that set $vite_entry
require_once __DIR__ . '/vite.inc.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : "IT Duck"; ?></title>

    <!-- Correctly link the single stylesheet -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/light-mode.css">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo htmlspecialchars($baseurl); ?>favicon.ico" type="image/x-icon">

    <!-- Critical theme persistence script - NOW CORRECTED and WITH NONCE -->
    <script nonce="<?php echo $csp_nonce; ?>">
        // IIFE to set theme immediately to prevent FOUC
        (function() {
            // Your CSS is dark by default, so we only need to check for light mode.
            const theme = localStorage.getItem('theme');
            if (theme === 'light') {
                document.documentElement.classList.add('light-mode');
            }
        })();
    </script>

    <?php
    //* Include Vite tags for CSS and JS, only when the page sets $vite_entry
    if (isset($vite_entry)): ?>
        <?php echo vite_tags($vite_entry); ?>
    <?php endif; ?>
</head>
