<?php
// 2026/api/projects.php
// JSON API endpoint serving GitHub repo data for the projects section.
//
// Caches GitHub's response to a local JSON file for 1 hour, avoids
// hitting GitHub on every page load and keeps the page fast regardless
// of GitHub's response time.

require_once __DIR__ . '/../inc/config.php';

header('Content-Type: application/json');
header('Cache-Control: no-store');

// Helper function to send JSON reponse and exit
function respond(bool $success, $data = null, string $error = ''): void {
    if ($success) {
        echo json_encode(['success' => true, 'repos' => $data]);
    } else {
        echo json_encode(['success' => false, 'error' => $error]);
    }
    exit;
}

// GitHub API configuration
$repos = ['InspectorSpy/home-server', 'InspectorSpy/KaliaBot'];
$cache_file = __DIR__ . '/../data/github-cache.json';
$cache_ttl = 3600; // 1 hour

// Serve from cache if it exists and isn't stale
if (is_file($cache_file) && (time() - filemtime($cache_file)) < $cache_ttl) {
    $cached = json_decode(file_get_contents($cache_file), true);
    if (is_array($cached)) {
        respond(true, $cached);
    }
}

// Cache missing or stale, fetch fresh from GitHub
$token = $_ENV['GITHUB_TOKEN'] ?? '';
$result = [];

// Fetch data for each repo from GitHub API
foreach ($repos as $repo) {
    $context = stream_context_create([
        'http' => [
            'header' => implode("\r\n", array_filter([
                'User-Agent: itduck.fi',
                'Accept: application/vnd.github+json',
                $token ? "Authorization: Bearer {$token}" : null,
            ])),
            'ignore_errors' => true, // Get response even on HTTP ignore_errors
            'timeout' => 5,
        ],
    ]);

    // Fetch repo data from GitHub API
    $response = @file_get_contents("https://api.github.com/repos/{$repo}", false, $context);
    if ($response === false) {
        continue; // skip this repo on failure, don't fail the whole request
    }

    // Decode JSON response and check for errors
    $data = json_decode($response, true);
    if (!is_array($data) || isset($data['message'])) {
        continue; // GitHub returned an error (rate limit, not found, etc.)
    }

    // Extract relevant fields and store in result
    $result[$repo] = [
        'name' => $data['name'] ?? $repo,
        'description' => $data['description'] ?? '',
        'language' => $data['language'] ?? null,
        'stars' => $data['stargazers_count'] ?? 0,
        'updated_at' => $data['pushed_at'] ?? null,
        'url' => $data['html_url'] ?? "https://github.com/{$repo}",
    ];
}

// If we got no valid data from GitHub, respond with an error
if (empty($result)) {
    // GitHub was unreachable / errored for every repo, and cache was
    // stale/missing, nothing to serve
    http_response_code(502);
    respond(false, null, 'Could not fetch project data.');
}

// Write to cache for next time (best-effort, don't fail the response if this fails)
@file_put_contents($cache_file, json_encode($result));

respond(true, $result);
