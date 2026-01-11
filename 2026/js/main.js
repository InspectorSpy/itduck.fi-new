// Mobile Menu Toggle
document.addEventListener("DOMContentLoaded", function() {

    // Mobile navigation tools
    const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
    const navMenu = document.querySelector(".nav-menu");

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener("click", function() {
            navMenu.classList.toggle("actove");

            // Animate hamburger icon
            this.classList.toggle("active");
        });

        // Close menu when clicking outside
        document.addEventListener("click", function(event) {
            const isClickInside = navMenu.contains(event.targer);
            const isCLickOnToggle = mobileMenuToggle.contains(event.target);

            if (!isClickInside && !isCLickOnToggle && navMenu.classList.contains("active")) {
                navMenu.classList.remove("active");
                mobileMenuToggle.classList.remove("active");
            }
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    });

    // Form validation (basic example)
    const contactForm = document.querySelector(".contact-form");
    if (contactForm) {
        contactForm.addEventListener("submit", function(e) {
            e.preventDefault();

            // Get form values
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("message").value.trim();

            // Basic validation
            if (name === "" || email === "" || message === "") {
                alert("Please fill in all fields.");
                return false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Success message (in a real app, the form would be sent to a server)
            alert("Thank you for your message! We will get back to you soon.");
            contactForm.reset();
        
        });
    }

    // Add fade-in animation for content sections
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    // Observe all content sections
    document.querySelectorAll(".content-section, .feature-card").forEach(section => {
        section.style.opacity = "0";
        section.style.transform = "translateY(20px)";
        section.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        observer.observe(section);
    });
        
});

// Console welcome message
console.log("%c🚀 Welcome to the site!", "font-size: 20px; color: #2563eb; font-weight: bold;");
console.log("%cBuilt with PHP component architecture", "font-size: 14px; color: #6b7280;");