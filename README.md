# itduck.fi, rebuilt

A clean, new, component-based version built with PHP.

## Architecture plans

- **PHP Router** for clean URLs
- **Component-based structure** with reusable includes
- **No build process**, pure PHP
- **Easy deployment** to any PHP hosting
- **Security-focused** with CSP, input sanitization, and security headers

## Structure plan

```
├── 2026/                # Main site folder
│   ├── index.php        # Homepage
│   ├── about.php        # About page
│   ├── contact.php      # Contact page
│   ├── router-dev.php   # Development router for clean URLs
│   ├── .htaccess        # URL rewriting & security headers
│   ├── robots.txt       # SEO configuration
│   ├── inc/             # Reusable components
│   │   ├── config.php
│   │   ├── security-headers.php
│   │   ├── head.inc.php
│   │   ├── navigation.inc.php
│   │   ├── header.inc.php
│   │   └── footer.inc.php
│   ├── css/             # Stylesheets
│   │   └── styles.css
│   ├── js/              # JavaScript
│   │   └── main.js
│   ├── img/             # Images
│   └── data/            # JSON message storage (gitignored)
├── .gitattributes
├── .gitignore
├── LICENSE
├── README.md
└── TODO.md
```

## Requirements

- PHP 7.4 or higher
- Web server (Apache/Nginx for production, or PHP's built-in server for development)
- Apache `mod_rewrite` enabled (for `.htaccess` URL routing)

## Development

To run locally with PHP's built-in server:

```bash
cd 2026
php -S localhost:8000 router-dev.php
```

## Security features

- Content Security Policy (CSP) with nonces
- Security headers configured in `.htaccess` and PHP
- Input sanitization and XSS prevention
- HTTPS enforcement (HSTS)
- Frame protection and MIME sniffing prevention

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### Branding Exception

The ITDuck logo (`2026/img/ITDuck.png`) and favicon (`2026/favicon.ico`) are **NOT** 
covered by the MIT License. All rights reserved.  Please do not use these assets 
without permission. 

If you fork this project, please replace the logo with your own branding.