<?php 
/**
 * Security headers configuration
 * 
 * Implements Content Security Policy (CSP) and other security headers
 * to protect against XSS, clickjacking, and injection attacks.
 */

// Generate random nonce for inline scripts
// This allows specific inline scripts while blocking unathorized ones
if (!function_exists("generate_csp_nonce")) {
    function generate_csp_nonce() {
        return base64_encode(random_bytes(16));
    }
}

// Generate nonce for this page load
$csp_nonce = generate_csp_nonce();

// Content Security Policy
// This is the primary defense against XSS attacks
$csp_directives = [
    // Default fallback: only allow resources from same origin
    "default-src 'self'",

    // Scripts: Allow own scripts, JQuery CDN, and nonce-based inline scripts
    "script-src 'self' https://code.jquery.com 'nonce-{$csp_nonce}'",

    // Styles: Allow own stylesheets and inline styles
    // Note: 'unsafe-inline' is needed for your current inline styles
    // Consider moving inline styles to external files for better security
    "style-src 'self' 'unsafe-inline'",

    // Images: Allow same origin and data: URIs (for base64 images)
    "img-src 'self' data:",

    // Fonts: Only allow fonts from same origin
    "font-src 'self'",

    // AJAX/Fetch: Only allow connctions to same origin
    "connect-src 'self'",

    // Frames: Prevent site from being embedded in iframes (clickjacking protection)
    "frame-ancestors 'none'",

    // Base tag: Only allow base URL from same origin
    "base-uri 'self'",

    // Forms: Only allow form submissions from same origin
    "form-action 'self'",

    // Block mixed content (HTTP resources on HTTPS pages)
    "upgrade-insecure-requests",
];

// Join all CSP directives
$csp_header = implode('; ', $csp_directives);

// Set Content Security Policy header
header("Content-Security-Policy: {$csp_header}");

// Additional Security Headers

// Prevent clickjacking: Don't allow site to be embedded in iframes
header("X-Frame-Options: DENY");

// Prevent MIME type sniffing
// Forces browser to respect declared content types
header("X-Content-Type-Options: nosniff");

// Enable XSS protection in older browsers (legacy support)
// Modern browsers use CSP instead, but this doesn't hurt
header("X-XSS-Protection: 1; mode=block");

// Referrer Policy: Control how much referrer information is sent
// 'strict-origin-when-cross-origin' is a good balance of privacy and functionality
header("Referrer-Policy: strict-origin-when-cross-origin");

// Permissions Policy (formerly Feature Policy)
// Disable access to sensitive browser features
$permissions_policy = [
    "geolocation=()",   // Disable geolocation
    "microphone=()",    // Disable microphone
    "camera=()",        // Disable camera
    "payment=()",       // Disable payment APIs
    "usb=()",           // Disable USB access
    "magnetometer=()",  // Disable magnetometer
    "gyroscope=()",     // Disable gyroscope
    "accelerometer=()"  // Disable accelerometer
];

header("Permissions-Policy: " . implode(", ", $permissions_policy));

// Strict Transport Security (HSTS)
// Force HTTPS for 1 year (31536000 seconds)
// Only enable this if your site is fully HTTPS!
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    header("Strict-Transport-Security:  max-age=31536000; includeSubDomains; preload");
}

?>