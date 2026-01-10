# itduck.fi new

A clean, component-based version built with PHP.

## Architecture plans

- **PHP Router** for clean URLs
- **Component-based structure** with reusable includes
- **No build process** - pure PHP
- **Easy deployment** to any PHP hosting

## Local Development

```bash
# Clone the repository
git clone https://github.com/YOUR-USERNAME/YOUR-REPO.git
cd YOUR-REPO

# Start the development server
php -S localhost:8080 router-dev. php

# Visit in browser
open http://localhost:8080
```

## Structure plan

```
├── router-dev.php       # Development router for clean URLs
├── 2026/                # Main site folder
│   ├── index. php        # Homepage
│   ├── about.php        # About page
│   ├── inc/             # Reusable components
│   │   ├── head.inc.php
│   │   ├── navigation.inc.php
│   │   ├── header.inc.php
│   │   └── footer.inc.php
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript
│   └── img/             # Images
└── README.md
```

## Requirements

- PHP 7.4 or higher
- Web server (Apache/Nginx for production, or PHP's built-in server for development)

## License

MIT