<?php
// Initialize config if not already done (for session and baseurl)
if (session_status() === PHP_SESSION_NONE) {
    require_once __DIR__ . '/config.php';
}

// Enforce security headers immediately
require_once __DIR__ . '/security-headers.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ?htmlspecialchars($page_title) : "IT Duck"; ?></title>
</head>

    <!-- Preconnect for performance -->
     <link rel="preconnect" href="https://code.jquery.com">
     <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- Stylesheets -->
     <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/main.css">
     <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/dark.css" media="(prefers-color-scheme: dark)">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo htmlspecialchars($baseurl); ?>img/favicon-dark.svg" type="image/svg+xml">

    <!-- Critical theme persistence script - NOW WITH NONCE -->
     <script nonce=""<?php echo $csp_nonce; ?>">
        // IIFE to set theme immediately to prevent FOUC
        (function() {
            const theme = localStorage.getItem('theme') || 'dark';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark-mode-loading');
            }
        })();
     </script>"
</head>