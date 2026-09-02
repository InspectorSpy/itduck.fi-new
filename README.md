# itduck.fi, rebuilt

A personal portfolio site: PHP for the page shell and routing, React mounted in for the projects section and contact form, built with Vite for the React part. The site is designed to be fast, secure, and easy to deploy.

## Architecture plans

- **PHP Router** for clean URLs, page shell (nav, footer, security headers, CSP nonces) shared across every page
- **React, mounted in specific pages** (Contact form done, projects section in progress), not a standalone SPA, the PHP shell stays for every pagem React only takes over the content area on pages that opt into it
- **Vite build**, source lives in `react-src/`, output lands in `2026/dist/` and is committed (no CI/CD, this repo is deployed by checking it out directly on the production box, so build output has to be present in git, not generated at deploy time)
- **Composer** for PHP dependencies (PHPMailer for SMTP, phpdotenv for environment variables)
- **Security-focused** CSP with nonces, CSRF protection, input sanitization, security headers, origin firewalled to Cloudflare's IP ranges only.

## Structure plan

```
├── 2026/                     # Main site folder (Apache DocumentRoot)
│   ├── index.php             # Homepage
│   ├── about.php             # About page
│   ├── contact.php           # Contact page (React-mounted)
│   ├── api/
│   │   └── contact.php       # JSON endpoint, sends email via Proton SMTP
│   ├── router-dev.php        # Router for clean URLs (used in production too)
│   ├── .htaccess             # URL rewriting & security headers
│   ├── robots.txt            # SEO configuration
│   ├── dist/                 # Built React bundle (committed, see note above)
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
│   └── data/                  # Legacy JSON message storage, gitignored,
│                              # no longer written to (contact form sends
│                              # email instead), kept for now, unused
├── react-src/                 # Vite + React source (outside the
│   ├── src/                   # DocumentRoot, not web-served directly)
│   │   ├── main.jsx
│   │   └── App.jsx            # Contact form component
│   └── vite.config.js         # Builds to ../2026/dist
├── vendor/                    # Composer packages, gitignored
├── node_modules/              # (inside react-src/), gitignored
├── .env                       # SMTP credentials, gitignored, not present
│                              # in a fresh clone, see Setup below
├── .nvmrc                     # Pins Node version for the build
├── composer.json / composer.lock
├── .gitattributes
├── .gitignore
├── LICENSE
├── README.md
└── TODO.md
```

## Requirements

- PHP 8.2
- Composer
- Node 22 (via `nvm`, see `.nvmrc`) - build-time only, not a running service
- Web server with `mod_rewrite` (Apache) for `.htaccess` URL routing
- A mail account with a custom domain and SMTP submission enabled, for the contact form's email delivery

## Setup (fresh clone)

```bash
composer install
cd react-src && npm install && npm run build && cd ..
cp .env.example .env    # then fill in real values, see below
```

`.env` needs:
```
SMTP_HOST=smtp.example.com
SMTP_USER=your_smtp_username
SMTP_TOKEN=your_smtp_password_or_token
```

Any SMTP provider works here, just set SMTP_HOST, SMTP_USER, and SMTP_TOKEN to match your provider's values.

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

There is no persistent dev server in normal use; Vite is a build-time tool only, and a dev server wouldn't be reachable through Cloudflare anyway (the origin firewall only accepts port 443 traffic from the IP ranges)

## Security features

- Content Security Policy (CSP) with nonces, single source of truth in `inc/security-headers.php` (do not also set headers in `.htaccess`, browsers enforce multiple CSP headers as an intersection, which silently breaks nonce-based inline scripts)
- CSRF protection (session token, sent as a header for the JSON API)
- Session-based rate limiting on the contact form
- Origin server firewalled (both IPv4 and IPv6) to accept port 443 traffic only from cloudflare's published IP ranges
- Input sanitization and XSS prevention
- HTTPS enforcement (HSTS)
- Frame protection and MIME sniffing prevention

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### Branding Exception

The ITDuck logo (`2026/img/ITDuck.png`) and favicon (`2026/favicon.ico`) are **NOT** covered by the MIT License. All rights reserved.  Please do not use these assets 
without permission. 

If you fork this project, please replace the logo with your own branding.
