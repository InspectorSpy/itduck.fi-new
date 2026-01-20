<?php
$uri  = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH); // Remove query string

// Serve static files directly (css, js, images, favicon, etc.)
if (file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
    return false;
}

// Serve assets in subfolders (e.g., css, js, img)
if (preg_match("#^/(css|js|img|fonts|webfonts|videos)(/.*)?$#", $path)) {
    $file = __DIR__ . $path;
    if (file_exists($file)) {
        return false;
    }
}

// Page rewrites for pretty URLs
$pages = [
    'about', 'contact', 'view-messages'
];

foreach ($pages as $page) {
    if ($path === "/$page") {
        require __DIR__ . "/$page.php";
        exit;
    }
}

// Profile asset rewrite
if (preg_match("#^/profile/(css|img|js)/(.+)$#", $path, $m)) {
    $file = "/{$m[1]}/{$m[2]}";
    if (file_exists(__DIR__ . $file)) {
        return false;
    }
}

// Profile URL rewrite
if (preg_match("#^/profile/([^/]*)$#", $path, $m)) {
    $_GET['profile'] = $m[1];
    require __DIR__ . "/profile.php";
    exit;
}

// Favicon rewrite
if ($path === "/profile/favicon.ico" || $path === "/favicon.ico") {
    require __DIR__ . "/favicon.ico";
    exit;
}

// Default: serve index
require __DIR__ . "/index.php";

