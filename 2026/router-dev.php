<?php
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH); // Remove query string

// Serve static files directly (css, js, images, favicon, etc.)
if (file_exists(__DIR__ . $path) && ! is_dir(__DIR__ . $path)) {
    return false;
}

// Default folder
$folder = '2026';

// Serve assets in subfolders (css, js, img, fonts)
if (preg_match("#^/$folder/(css|js|img|fonts|videos)(/.*)?$#", $path)) {
    $file = __DIR__ . $path;
    if (file_exists($file)) {
        return false;
    }
}

// Page rewrites for pretty URLs
$pages = ['about', 'contact', 'services', 'portfolio', 'view-messages'];

foreach ($pages as $page) {
    if ($path === "/$folder/$page" || $path === "/$page") {
        require __DIR__ . "/$folder/$page.php";
        exit;
    }
}

// Favicon handling
if ($path === "/$folder/favicon.ico" || $path === "/favicon.ico") {
    if (file_exists(__DIR__ . "/$folder/favicon.ico")) {
        return false;
    }
}

// Default: serve index.php
require __DIR__ . "/$folder/index.php";