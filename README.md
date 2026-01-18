# itduck.fi new

A clean, new, component-based version built with PHP.

## Architecture plans

- **PHP Router** for clean URLs
- **Component-based structure** with reusable includes
- **No build process**, pure PHP
- **Easy deployment** to any PHP hosting

## Structure plan

```
├── router-dev.php       # Development router for clean URLs
├── 2026/                # Main site folder
│   ├── index. php       # Homepage
│   ├── about.php        # About page
│   ├── inc/             # Reusable components
│   │   ├── head.inc.php
│   │   ├── navigation.inc.php
│   │   ├── header.inc.php
│   │   └── footer.inc.php
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript
│   |── img/             # Images
|   └── router-dev.php   # Development router for clean URLs
|── README.md
└── TODO.md

```

## Requirements

- PHP 7.4 or higher
- Web server (Apache/Nginx for production, or PHP's built-in server for development)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### Branding Exception

The ITDuck logo (`2026/img/ITDuck.png`) and favicon (`2026/favicon.ico`) are **NOT** 
covered by the MIT License. All rights reserved.  Please do not use these assets 
without permission. 

If you fork this project, please replace the logo with your own branding.
