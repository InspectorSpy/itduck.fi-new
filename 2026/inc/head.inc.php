<?php
// Include config if not already loaded
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/config.php';
}

// Set default page title if not set
if (!isset($page_title)) {
    $page_title = SITE_NAME;
}
?>
<head>
    <meata charset="UTF-8">
    <meta name="viewport" content=""width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Welcome to ' . SITE_NAME; ?>">

    <title><?php echo $page_title; ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $baseurl; ?>css/styles.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $baseurl; ?>favicon.ico">

    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>