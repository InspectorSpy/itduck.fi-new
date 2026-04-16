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
- [x] Added a raw robots.txt file
- [x] Added SRI protection
- [x] Sanitized contact form inputs with proper encoding
- [x] Add session security with httponly, secure, samesite flags + regeneration
- [x] Add server-side email validation
- [x] Mobile nav fixed
---

## Content improvements

- [x] Add real content to About page
    - [x] Improve content on About page
        - [ ] Improve more
- [ ] Build out Projects page with portfolio items
- [ ] Add services/skills section
- [ ] Write compelling home page copy
- [ ] Add professional bio and background
- [ ] Embed github repos in Projects page

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
- [X] Add robots.txt

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
- [x] Add CSRF protection to contact form
- [x] Implement rate limiting on form submissions
- [x] Add `.htaccess` or server config for security headers
- [x] Add security headers (CSP, X-Frame-Options, etc.)
- [x] Protect `/data` directory from web access

---

## Mobile & Responsive

- [x] Test on various mobile devices
- [x] Optimize touch targets for mobile
- [x] Test landscape/portrait orientations
- [ ] Ensure images scale properly on all screen sizes

---

## Server Configuration

- [x] Configure Apache DocumentRoot to `/var/www/itduck.fi/2026/`
- [x] Enable mod_rewrite
- [x] Enable mod_headers (for CSP)
- [x] Set proper file permissions (www-data ownership)
- [x] Configure default site to prevent IP access
- [x] Implement Content Security Policy with nonce
- [x] Configure security headers (X-Frame-Options, X-Content-Type-Options, etc.)
- [x] Set up HSTS (Strict-Transport-Security)
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
- **Security**: CSP implemented with nonce-based inline script protection
- **Data Protection**: `/data` directory blocked via .htaccess
- **Headers**: Security headers set in both PHP (inc/security-headers.php) and .htaccess

________________________________________________________________________________________


## Security Improvements

### 🔴 HIGH PRIORITY

#### 1. Remove `'unsafe-inline'` from CSP Styles
- [ ] Find all inline styles in code
- [ ] Move to external CSS OR add nonces:  `<style nonce="<? php echo $csp_nonce; ? >">`
- [ ] Update CSP to `style-src 'self' 'nonce-{random}'`
- [ ] Test all pages
- **Files:** `inc/security-headers.php`, `.htaccess`

#### 2. Add CSRF Protection to Contact Form
- [x] Generate token:  `$_SESSION['csrf_token'] = bin2hex(random_bytes(32));`
- [x] Add hidden field:  `<input type="hidden" name="csrf_token" value="<? php echo $_SESSION['csrf_token']; ? >">`
- [x] Validate in contact.php before processing
- **Files:** `contact.php`, `inc/config.php`

#### 3. Fix/Delete Insecure Message Viewer
- [ ] **Option A:** Delete `view-messages.php` (read via SSH:  `cat data/messages.json`)
- [ ] **Option B:** Implement bcrypt passwords, rate limiting, CSRF, session timeout
- **File:** `view-messages.php`

#### 4. Add Rate Limiting to Contact Form
- [x] Track submissions per IP in session (max 5 per hour)
- [x] Block excessive submissions
- **File:** `contact.php`

---

### 🟡 MEDIUM PRIORITY

#### 5. Add CSP Reporting
- [ ] Create `csp-report.php` to log violations
- [ ] Add `report-uri /csp-report. php` to CSP header
- [ ] Monitor `data/csp-violations.log`

#### 6. Validate Router Inputs
- [ ] Check for path traversal (`.. `, null bytes)
- [ ] Validate path format
- **File:** `router-dev.php`

#### 7. Remove `upgrade-insecure-requests` from CSP
- [ ] Remove from CSP (redundant with HSTS)
- **Files:** `inc/security-headers.php`, `.htaccess`

#### 8. Add Server-Side Email Validation
- [X] Use `filter_var($email, FILTER_VALIDATE_EMAIL)`
- **File:** `contact.php`

---

### 🧪 TESTING CHECKLIST

**CSP Scripts:**
- [X] Try `eval('alert("XSS")')` in console → Should be blocked

**CSP Inline Scripts:**
- [ ] Add `<script>alert('test')</script>` → Should be blocked
- [ ] Add with nonce → Should work

**CSRF:**
- [x] Submit form from external site → Should be rejected
- [x] Tamper with token in dev tools -> Should be rejected

**Rate Limiting:**
- [x] Submit form 6 times rapidly → 6th should be blocked

---

### 📊 SECURITY PROGRESS

| Layer | Current | After High Priority | Target |
|-------|---------|---------------------|--------|
| HTTPS/TLS | 10/10 | 10/10 | 10/10 |
| CSP (Scripts) | 9.5/10 | 10/10 | 10/10 |
| CSP (Styles) | 4/10 | 9/10 | 10/10 |
| CSRF | 9/10 | 9/10 | 9/10 |
| Auth | 2/10 | 8/10 | 9/10 |
| Rate Limiting | 8/10 | 8/10 | 9/10 |
| **OVERALL** | **7.1/10** | **8.3/10** | **9.5/10** |

---

### 📚 RESOURCES

- CSP Validator: https://csp-evaluator.withgoogle.com/
- Security Headers:  https://securityheaders.com/?q=itduck.fi
- SRI Generator: https://www.srihash.org/
- OWASP CSRF:  https://cheatsheetseries.owasp.org/

---

### 📝 SECURITY NOTES

- CSP nonce system is working ✅
- Main vulnerabilities:  CSP styles, authentication on message viewer
- `data/` directory is protected ✅
- Backup `data/messages.json` before changes
- `'unsafe-inline'` in styles defeats CSP for CSS attacks
- **CSRF and Rate Limiting have been implemented ✅**
