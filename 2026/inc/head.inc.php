<?php
// Initialize config if not already set
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/config.php';
}
// Enforce security headers immediately
require_once __DIR__ . '/security-headers.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : "IT Duck"; ?></title>

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://code.jquery.com">

    <!-- Correctly link the single stylesheet -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/light-mode.css">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo htmlspecialchars($baseurl); ?>img/favicon-dark.svg" type="image/svg+xml">

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
</head>