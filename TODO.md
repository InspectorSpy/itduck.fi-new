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

- [ ] Prepare for hosting (choose hosting provider)
- [ ] Set up real email sending for contact form
- [ ] Configure production environment variables
- [ ] Set up SSL/HTTPS
- [ ] Create deployment documentation
- [ ] Set up analytics (Google Analytics, etc.)
- [ ] Test on multiple browsers and devices
- [ ] Create backup strategy for contact form data

---

## Security Enhancements

- [ ] Change default password in `view-messages.php` (will probably be deleting this page.)
- [ ] Add CSRF protection to contact form
- [ ] Implement rate limiting on form submissions
- [ ] Add `.htaccess` or server config for security headers
- [ ] Protect `/data` directory from web access

---

## Mobile & Responsive

- [ ] Test on various mobile devices
- [ ] Optimize touch targets for mobile
- [ ] Test landscape/portrait orientations
- [ ] Ensure images scale properly on all screen sizes

---

## Notes

- Site uses PHP with component architecture
- Messages saved to:  `2026/data/messages.json`
- "Admin" viewer:  `/2026/view-messages.php`
- Current password: `notsecure` (Implementation is not a secure method!)
