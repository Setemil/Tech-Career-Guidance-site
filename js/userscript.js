document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const closeMenuBtn = document.querySelector('.close-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    // Mobile menu toggle
    mobileMenuBtn.addEventListener('click', function() {
        navLinks.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    closeMenuBtn.addEventListener('click', function() {
        navLinks.classList.remove('active');
        document.body.style.overflow = '';
    });

    // Close mobile menu when a nav link is clicked
    document.querySelectorAll('.nav-link, .logout-btn').forEach(link => {
        link.addEventListener('click', function() {
            navLinks.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (navLinks.classList.contains('active') && 
            !navLinks.contains(e.target) && 
            e.target !== mobileMenuBtn &&
            !mobileMenuBtn.contains(e.target)) {
            navLinks.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && navLinks.classList.contains('active')) {
            navLinks.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});