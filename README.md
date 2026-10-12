# itduck.fi, rebuilt

A personal portfolio site: PHP for the page shell and routing, React mounted in for the projects page and contact form, built with Vite for the React part. The site is designed to be fast, secure, and easy to deploy.

## Architecture

- **PHP Router** for clean URLs, page shell (nav, footer, security headers, CSP nonces) shared across every page
- **React, mounted in specific pages**, not a standalone SPA, the PHP shell stays for every page, React only takes over the content area on pages that opt in by setting `$vite_entry`:
  - `contact.php` mounts `src/contact/main.jsx`
  - `projects.php` mounts `src/projects/main.jsx`
- **Vite build with two entries** (`contact`, `projects`), source lives in `react-src/`, output lands in `2026/dist/` and is committed (no CI/CD, this repo is deployed by checking it out directly on the production box, so build output has to be present in git, not generated at deploy time)
- **Asset helper**: `inc/vite.inc.php` reads `dist/manifest.json` and emits the hashed JS/CSS tags plus `modulepreload` for shared chunks, so browsers and Cloudflare never serve a stale bundle after a deploy
- **Two JSON endpoints** under `2026/api`: `contact.php` (validates the form and sends email over SMTP) and `projects.php` (cached GitHub API proxy)
- **Composer** for PHP dependencies (PHPMailer for SMTP, phpdotenv for environment variables)
- **Security-focused** CSP with nonces, CSRF protection, input sanitization, security headers, origin firewalled to Cloudflare's IP ranges only.

## How the projects page works

The page combines authored text with live GitHub data.

1. `react-src/src/projects/projects-data.js` holds the write-ups. Each entry has `title`, `short`, `stack` and `repo`.
2. `repo` is either an `"owner/repo"` string or `null`. Private projects, or ones without a public repo, use `null` and are shown as text only.
3. On load, `App.jsx` calls `/api/projects.php` once (`useEffect` with an empty dependency array). The response is a map keyed by `owner/repo` with name, description, language, stars, updated date and URL.
4. Cards with a matching entry get an extra GitHub line (language, last update, link).
5. The search box filters the cards client-side, case-insensitively, across title, short description and stack.

### The API proxy

`api/projects.php` calls the GitHub API server-side with a fine-grained token (public repositories, read-only), so the token never reaches the browser. Results are cached in `2026/data/github-cache.json` for one hour so page views do not spend GitHub rate limit.

The repos it fetches are the fixed `$repos` array at the top of `api/projects.php`. This is an allowlist on purpose, so the endpoint cannot be used to query arbitrary repositories.

### Adding a project

1. Add an object to `projects-data.js`. Use `repo: null` for text only.
2. For a public repo with live stats, set `repo: 'owner/repo'` and add the same string to `$repos` in `api/projects.php`.
3. Rebuild (`cd react-src && npm run build`) and commit `2026/dist` together with the source change.
4. If you added a repo, delete `2026/data/github-cache.json` or wait up to an hour for the cache to expire.

## Structure

```
├── 2026/                     # Main site folder (Apache DocumentRoot)
│   ├── index.php             # Homepage
│   ├── about.php             # About page
│   ├── contact.php           # Contact page (React-mounted)
│   ├── projects.php          # Projects page (React-mounted)
│   ├── api/
│   │   ├── contact.php       # JSON endpoint, sends email over SMTP
│   │   └── projects.php      # GitHub API proxy with 1 h file cache
│   ├── router-dev.php        # Router for clean URLs (used in production too)
│   ├── .htaccess             # URL rewriting
│   ├── robots.txt            # SEO configuration
│   ├── dist/                 # Built React bundles (committed, see note above)
│   │   ├── manifest.json
│   │   └── assets/
│   ├── inc/                  # Reusable components
│   │   ├── config.php        # Loads .env, site constants, session setup
│   │   ├── vite.inc.php      # Reads dist/manifest.json, emits asset tags
│   │   ├── security-headers.php
│   │   ├── head.inc.php
│   │   ├── navigation.inc.php
│   │   ├── header.inc.php
│   │   └── footer.inc.php
│   ├── css/
│   ├── js/
│   ├── img/
│   └── data/                  # Runtime data, gitignored, must be writable
│                              # by the web server (holds the GitHub cache)
├── react-src/                 # Vite + React source (outside the
│   ├── src/                   # DocumentRoot, not web-served directly)
│   │   ├── contact/
│   │   │   ├── main.jsx
│   │   │   └── App.jsx        # Contact form component
│   │   └── projects/
│   │       ├── main.jsx
│   │       ├── App.jsx        # Search and project cards
│   │       └── projects-data.js  # Authored project write-ups
│   └── vite.config.js         # Two inputs, builds to ../2026/dist
├── vendor/                    # Composer packages, gitignored
├── node_modules/              # (inside react-src/), gitignored
├── .env                       # Secrets, gitignored, not present
│                              # in a fresh clone, see Setup below
├── .env.example               # Template for .env
├── .nvmrc                     # Pins Node version for the build
├── composer.json / composer.lock
├── .gitattributes
├── .gitignore
├── LICENSE
├── README.md
└── TODO.md
```

## Requirements

- PHP 8.2 with `openssl` and `allow_url_fopen` enabled (the GitHub proxy uses `file_get_contents` over HTTPS)
- Composer
- Node 22 (via `nvm`, see `.nvmrc`) - build-time only, not a running service
- Web server with `mod_rewrite` (Apache) for `.htaccess` URL routing
- A mail account with a custom domain and SMTP submission enabled, for the contact form's email delivery
- A GitHub fine-grained personal access token with read-only access to public repositories, for the projects page

## Setup (fresh clone)

```bash
composer install
cd react-src && npm install && npm run build && cd ..
cp .env.example .env    # then fill in real values, see below
mkdir -p 2026/data      # must be writable by the web server user
```

`.env` needs:
```
SMTP_HOST=smtp.example.com
SMTP_USER=your_smtp_username
SMTP_TOKEN=your_smtp_password_or_token
GITHUB_TOKEN=github_pat_xxxxxxxx
```

Any SMTP provider works here, just set SMTP_HOST, SMTP_USER, and SMTP_TOKEN to match your provider's values. Fine-grained GitHub tokens expire, so note the expiry date and renew the token before it lapses.

### `.env` permissions (important)

Apache runs as `www-data`, so it must be able to read `.env`:

```bash
sudo chown <your-user>:www-data .env
chmod 640 .env
```

Do **not** use `chmod 600`. phpdotenv is loaded with `safeLoad()`, which fails silently when the file is unreadable, so the site keeps running but SMTP and GitHub calls break with no obvious error. The same applies to `2026/data/`: if `www-data` cannot write there, the cache is never saved and every request hits the GitHub API.

## Development

To run locally with PHP's built-in server:

```bash
cd 2026
php -S localhost:8000 router-dev.php
```

To rebuild the React bundle after any change under `react-src/`:

```bash
cd react-src
npm run build
```

Commit the updated `2026/dist` together with the source change.

There is no persistent dev server in normal use; Vite is a build-time tool only, and a dev server wouldn't be reachable through Cloudflare anyway (the origin firewall only accepts port 443 traffic from the IP ranges).

### Testing the API endpoints

Cloudflare's bot challenge blocks `curl` against the public domain for `/api/*` and returns a challenge page instead of JSON. Test on the server against the origin instead:

```bash
curl -sk -H 'Host: itduck.fi' https://127.0.0.1/api/projects.php
```

Or test from a real browser session. Do not use on-box requests to verify the firewall, since they bypass it. Test that from outside the machine.

## Security features

- Content Security Policy (CSP) with nonces, single source of truth in `inc/security-headers.php` (do not also set headers in `.htaccess`, browsers enforce multiple CSP headers as an intersection, which silently breaks nonce-based inline scripts)
- CSRF protection (session token, sent as an `X-CSRF-Token` header for the JSON API, compared with `hash_equals`)
- Contact form hardening: 10 KiB body limit, JSON validation, field length caps, server-side email validation
- Session-based rate limiting on the contact form (5 per hour, a known weak point since a client can drop its session)
- GitHub token kept server-side, projects endpoint limited to a fixed repo allowlist and cached
- Origin server firewalled (both IPv4 and IPv6) to accept port 443 traffic only from Cloudflare's published IP ranges, which is why `CF-Connecting-IP` is trusted for client IPs
- Input sanitization and XSS prevention
- HTTPS enforcement (HSTS)
- Frame protection and MIME sniffing prevention

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### Branding Exception

The ITDuck logo (`2026/img/ITDuck.png`) and favicon (`2026/favicon.ico`) are **NOT** covered by the MIT License. All rights reserved.  Please do not use these assets 
without permission. 

If you fork this project, please replace the logo with your own branding.
