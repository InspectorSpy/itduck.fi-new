<?php
function vite_tags(string $entry = 'index.html'): string {
    static $manifest = null;
    if ($manifest === null) {
        $file = __DIR__ . '/../dist/manifest.json';
        $manifest = is_file ($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
    }
    if (!isset($manifest[$entry])) {
        return '<!-- vite: no build output for ' . htmlspecialchars($entry) . ' -->';
    }
    $chunk = $manifest[$entry];
    $base  = BASE_URL . 'dist/';
    $out   = '';
    foreach ($chunk['css'] ?? [] as $css) {
        $out .= '<link rel="stylesheet" href="' . htmlspecialchars($base . $css) . '">' . "\n";
    }
    $out .= '<script type="module" src="' . htmlspecialchars($base . $chunk['file']) . '"></script>';
    return $out;
}