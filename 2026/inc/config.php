<?php
// Site configuration
define('SITE_NAME', 'IT Duck');
define('BASE_URL','/');
define('CONTACT_EMAIL','inspectorspy(at)itduck.fi');

// Set base URL variable for use in templates
$baseurl = BASE_URL;

// Session security configuration
if (session_status() === PHP_SESSION_NONE) {
    // Configure secure session cookies before starting session
    ini_set('session.cookie_httponly', 1);          // Prevent JavaScript access to session cookies
    ini_set('session.cookie_secure', 1);            // Only send cookies over HTTPS
    ini_set('session.cookie_samesite', 'Strict');   // Cross-Site Request Forgery (CSRF) protection
    ini_set('session.use_strict_mode', 1);          // Rehect uninitialized session IDs
    ini_set('session.use_only_cookies', 1);         // Don't accept session IDs via URL

    // Start session with secure settings
    session_start();

    // Regenerate session ID every 30 minutes to prevent session fixation
    if (!isset($_SESSION['last_regeneration'])) {
        $_SESSION['last_regeneration'] = time();
    } elseif (time() - $_SESSION['last_regeneration'] > 1800) { // 1800 seconds = 30 minutes
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}