<?php
// Include config if not already loaded
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/config.php';
}

// Include security headers (must be before any output)
require_once __DIR__ . '/security-headers.php';

// Set default page title if not set
if (!isset($page_title)) {
    $page_title = SITE_NAME;
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($page_description) ? htmlspecialchars($page_description) : 'Welcome to ' . htmlspecialchars(SITE_NAME); ?>">

    <title><?php echo htmlspecialchars($page_title); ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($baseurl); ?>css/styles.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo htmlspecialchars($baseurl); ?>favicon.ico">

    <!-- jQuery (if needed): using CSP-approved CDN -->
    <script nonce="<?php echo htmlspecialchars($csp_nonce); ?>" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>