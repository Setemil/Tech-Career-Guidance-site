document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const header = document.querySelector('.header');
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const closeMenuBtn = document.querySelector('.close-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    const navLinksItems = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.section');

    // Check if mobile menu elements exist
    if (mobileMenuBtn && closeMenuBtn && navLinks) {
        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default behavior
            navLinks.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        });

        closeMenuBtn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default behavior
            navLinks.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        });

        // Close mobile menu when a nav link is clicked
        navLinksItems.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.classList.remove('active');
                document.body.style.overflow = ''; // Restore scrolling
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
    }

    // Header scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Intersection Observer for scroll animations
    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Once visible, stop observing
            }
        });
    }, {
        root: null,
        threshold: 0.15, // 15% of the element must be visible
        rootMargin: "-50px 0px" // Trigger slightly before the element comes into view
    });

    // Observe each section
    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // Testimonial slider initialization
    // Moved inside the main DOMContentLoaded to avoid conflicts
    function initTestimonialSlider() {
        console.log("Initializing testimonial slider");
        
        // Get all required elements
        const testimonials = document.querySelectorAll('.testimonial');
        const prevButton = document.querySelector('.testimonial-prev');
        const nextButton = document.querySelector('.testimonial-next');
        const dotsContainer = document.querySelector('.testimonial-dots');
        
        // Check if elements exist
        if (!testimonials.length || !prevButton || !nextButton || !dotsContainer) {
            console.error("Missing required elements for testimonial slider");
            return;
        }
        
        console.log(`Found ${testimonials.length} testimonials`);
        
        let currentSlide = 0;
        const totalSlides = testimonials.length;
        
        // Create dots for navigation
        // Clear existing dots first
        dotsContainer.innerHTML = '';
        testimonials.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.classList.add('testimonial-dot');
            if (index === 0) dot.classList.add('active');
            dotsContainer.appendChild(dot);
        });
        
        const dots = document.querySelectorAll('.testimonial-dot');
        
        // Add click events to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                console.log(`Dot clicked: ${index}`);
                goToSlide(index);
            });
        });
        
        // Add click events to buttons
        prevButton.addEventListener('click', () => {
            console.log("Previous button clicked");
            prevSlide();
        });
        
        nextButton.addEventListener('click', () => {
            console.log("Next button clicked");
            nextSlide();
        });
        
        // Set up the initial state
        showSlide(0);
        
        // Function to display a specific slide
        function showSlide(slideIndex) {
            console.log(`Showing slide ${slideIndex}`);
            
            // Update testimonials
            testimonials.forEach((testimonial, index) => {
                // Remove all classes first
                testimonial.classList.remove('active', 'prev', 'next');
                
                // Add appropriate class
                if (index === slideIndex) {
                    testimonial.classList.add('active');
                } else if (index < slideIndex) {
                    testimonial.classList.add('prev');
                } else {
                    testimonial.classList.add('next');
                }
            });
            
            // Update dots
            dots.forEach((dot, index) => {
                if (index === slideIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
            
            // Update current slide
            currentSlide = slideIndex;
        }
        
        // Function for next slide
        function nextSlide() {
            const newIndex = (currentSlide + 1) % totalSlides;
            showSlide(newIndex);
        }
        
        // Function for previous slide
        function prevSlide() {
            const newIndex = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(newIndex);
        }
        
        // Function to go to a specific slide
        function goToSlide(index) {
            showSlide(index);
        }
        
        // Set up auto rotation
        let autoRotate = setInterval(nextSlide, 5000);
        
        // Pause on hover
        const sliderContainer = document.querySelector('.testimonial-slider');
        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', () => {
                clearInterval(autoRotate);
            });
            
            sliderContainer.addEventListener('mouseleave', () => {
                autoRotate = setInterval(nextSlide, 5000);
            });
        }
        
        console.log("Testimonial slider initialized successfully");
    }
    
    // Initialize testimonial slider
    setTimeout(initTestimonialSlider, 100);

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                // Account for fixed header
                const headerHeight = header ? header.offsetHeight : 0;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Counting animation for stats
    const statElements = document.querySelectorAll('.stat-number');
    
    const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const target = parseInt(element.getAttribute('data-target'));
                let count = 0;
                const duration = 2000; // 2 seconds
                const frameRate = 50; // Update 50 times per second
                const increment = target / (duration / (1000 / frameRate));
                
                const counter = setInterval(() => {
                    count += increment;
                    if (count >= target) {
                        element.textContent = target.toLocaleString();
                        clearInterval(counter);
                    } else {
                        element.textContent = Math.floor(count).toLocaleString();
                    }
                }, 1000 / frameRate);
                
                observer.unobserve(element);
            }
        });
    }, {
        threshold: 0.5
    });
    
    statElements.forEach(stat => {
        statsObserver.observe(stat);
    });

    // Apply animation to all card types in a DRY way
    function setupCardAnimations(cards, observer) {
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    }
    
    // Generic card animation observer creator
    function createCardObserver() {
        return new IntersectionObserver((entries, observer) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Add staggered delay based on index
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 150 * index);
                    
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
    }
    
    // Set up all card animations
    const roadmapCards = document.querySelectorAll('.roadmap-card');
    const featureCards = document.querySelectorAll('.feature-card');
    const instructorCards = document.querySelectorAll('.instructor-card');
    
    setupCardAnimations(roadmapCards, createCardObserver());
    setupCardAnimations(featureCards, createCardObserver());
    setupCardAnimations(instructorCards, createCardObserver());

    // Handle window resize for mobile menu
    // This makes sure the menu state is consistent when resizing between mobile and desktop
    let mobileBreakpoint = 768; // Common mobile breakpoint, adjust as needed
    let wasMobile = window.innerWidth < mobileBreakpoint;
    
    window.addEventListener('resize', function() {
        const isMobile = window.innerWidth < mobileBreakpoint;
        
        // If transitioning from mobile to desktop, ensure menu is visible
        if (wasMobile && !isMobile) {
            navLinks.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        wasMobile = isMobile;
    });
});