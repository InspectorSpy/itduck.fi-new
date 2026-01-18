# TODO List

## Completed tasks

- [x] Fix browser favicon cache issue
- [x] Correct HTML typos in `head.inc.php`
- [x] Set up contact form backend (save messages to JSON file)
- [x] Prevent JavaScript from blocking PHP form submission
- [x] Create admin message viewer (`view-messages.php`)
- [x] Add password protection to message viewer
- [x] Fix password checking logic bug in message viewer
- [x] Debug and correct mobile navigation toggle (CSS/JS class mismatch)
- [x] Ensure dark theme and logo are applied
- [x] Set MIT license in repository
- [x] Fix nested directory structure (moved files form 2026/2026 to 2026/)
- [x] Configure Apache virtual host for itduck.fi domain
- [x] Set up SSL/HTTPS with Let's Encrypt
- [x] Fix CSS/JS asset paths (removed /2026/ prefix from URLs)
- [x] Configure BASE_URL in config.php
- [x] Set up URL routing with .htaccess and router-dev.php
- [x] Prevent server IP from showing website (domain-only access)
- [x] Deploy site to production server

---

## Content improvements

- [ ] Add real content to About page
- [ ] Build out Projects page with portfolio items
- [ ] Add services/skills section
- [ ] Write compelling home page copy
- [ ] Add professional bio and background

---

## Features to add

- [ ] Add a skills/resume section
- [ ] Create project showcase cards with images
- [ ] Add social media links (GitHub, LinkedIn, etc.)
- [ ] Implement project filtering/categories
- [ ] Add testimonials section (if applicable)
- [ ] Create a resume/CV download option

---

## Polish & optimization

- [ ] Add more animations and transitions
- [ ] Optimize images (compress, responsive sizes)
- [ ] Add meta tags for SEO
- [ ] Create custom 404 error page
- [ ] Add loading states/animations
- [ ] Improve accessibility (ARIA labels, keyboard navigation)
- [ ] Add print stylesheet
- [ ] Add robots.txt

---

## Deployment Preparation

- [x] Prepare for hosting (choose hosting provider)
- [x] Set up SSL/HTTPS
- [x] Test on multiple browsers and devices
- [ ] Set up real email sending for contact form
- [ ] Configure production environment variables
- [ ] Create deployment documentation
- [ ] Set up analytics (Google Analytics, etc.)
- [ ] Create backup strategy for contact form data

---

## Security Enhancements

- [ ] Change default password in `view-messages.php` (will probably be deleting this page.)
- [ ] Add CSRF protection to contact form
- [ ] Implement rate limiting on form submissions
- [x] Add `.htaccess` or server config for security headers
- [ ] Add security headers (CSP, X-Frame-Options, etc.)
- [ ] Protect `/data` directory from web access

---

## Mobile & Responsive

- [ ] Test on various mobile devices
- [ ] Optimize touch targets for mobile
- [ ] Test landscape/portrait orientations
- [ ] Ensure images scale properly on all screen sizes

---

## Server Configuration

- [x] Configure Apache DocumentRoot to `/var/www/itduck.fi/2026/`
- [x] Enable mod_rewrite
- [x] Set proper file permissions (www-data ownership)
- [x] Configure default site to prevent IP access
- [ ] Set up automated deployments (Git hooks or CI/CD)
- [ ] Configure server backups
- [ ] Set up monitoring/uptime checks

---

## Notes

- Site uses PHP with component architecture
- Messages saved to:  `2026/data/messages.json`
- "Admin" viewer:  `/2026/view-messages.php`
- Current password: `notsecure` (Implementation is not a secure method!)
- **Production URL**: https://itduck.fi
- **Server**: Hetzner (Debian + Apache)
