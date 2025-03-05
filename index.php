<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechPathway - Your Guide to a Tech Career</title>
    <link rel="stylesheet" href="css/landingstyle.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .about-section {
    padding: 60px 20px;
    background-color: #f9f9f9; /* Adjust as needed */
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.about-content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.about-text {
    flex: 1;
    min-width: 300px;
    max-width: 600px;
}

.about-text h2 {
    font-size: 2rem;
    margin-bottom: 15px;
}

.about-text p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 10px;
}

.about-image {
    flex: 1;
    display: flex;
    justify-content: center;
}

.about-image img {
    max-width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 10px; /* Optional for rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.stats-grid{
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-content {
        flex-direction: column;
    }

    .about-image img {
        width: 100%;
        max-height: 400px; /* Adjust max height to fit smaller screens */
    }
    .stats-grid{
    flex-direction: column;
    }
}

    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="#hero" class="logo">Tech<span>Pathway</span></a>
                <div class="nav-links">
                    <a href="#hero" class="nav-link active">Home</a>
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#roadmaps" class="nav-link">Roadmaps</a>
                    <a href="#instructors" class="nav-link">Instructors</a>
                    <a href="#about" class="nav-link">About Us</a>
                    <a href="#footer" class="nav-link">Contact</a>
                    <a href="#sign-up" class="btn btn-primary sign-up-btn">Sign Up</a>
                    <button class="close-menu-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Navigate Your Tech Career Journey With Confidence</h1>
                <p>TechPathway provides personalized roadmaps, expert guidance, and resources to help you launch and advance your career in technology. No matter where you are in your journey, we've got the path for you.</p>
                <div class="hero-btns">
                    <a href="#roadmaps" class="btn btn-primary">Explore Roadmaps</a>
                    <a href="LoginPage/index.php" class="btn btn-outline">Get Started Free</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="hero.jpeg" alt="Career guidance illustration">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container">
            <h2 class="text-center">Why Choose TechPathway?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Customized Roadmaps</h3>
                    <p>Follow step-by-step career paths designed by industry experts to reach your tech goals efficiently.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <h3>Curated Resources</h3>
                    <p>Access hand-picked external links and resources for every stage of your learning journey.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Expert Instructors</h3>
                    <p>Learn from industry professionals with years of experience in their respective tech fields.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>1-on-1 Mentoring</h3>
                    <p>Schedule personalized sessions with instructors for tailored guidance and feedback.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community Support</h3>
                    <p>Join a community of like-minded learners to share experiences and grow together.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Hands-on Projects</h3>
                    <p>Build your portfolio with practical projects that demonstrate your skills to employers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat">
                    <h3 class="stat-number" data-target="15000">0</h3>
                    <p>Active Learners</p>
                </div>
                <div class="stat">
                    <h3 class="stat-number" data-target="50">0</h3>
                    <p>Career Roadmaps</p>
                </div>
                <div class="stat">
                    <h3 class="stat-number" data-target="120">0</h3>
                    <p>Expert Instructors</p>
                </div>
                <div class="stat">
                    <h3 class="stat-number" data-target="92">0</h3>
                    <p>Success Rate (%)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roadmaps Section -->
    <section id="roadmaps" class="roadmaps section">
        <div class="container">
            <h2 class="text-center">Career Roadmaps</h2>
            <p class="text-center">Follow our structured learning paths to achieve your tech career goals</p>
            <div class="roadmap-cards">
                <div class="roadmap-card">
                    <h3>Web Development</h3>
                    <p>Master front-end and back-end technologies to become a full-stack web developer capable of building modern, responsive websites and web applications.</p>
                </div>
                <div class="roadmap-card">
                    <h3>Data Science</h3>
                    <p>Learn statistics, machine learning, and data visualization to extract insights from complex datasets and drive business decisions.</p>
                </div>
                <div class="roadmap-card">
                    <h3>Mobile Development</h3>
                    <p>Build native and cross-platform mobile applications for iOS and Android using modern frameworks and best practices.</p>
                </div>
                <div class="roadmap-card">
                    <h3>Cloud Computing</h3>
                    <p>Develop expertise in cloud platforms, infrastructure as code, and DevOps practices for scalable and reliable applications.</p>
                </div>
                <div class="roadmap-card">
                    <h3>Cybersecurity</h3>
                    <p>Master defensive and offensive security techniques to protect systems from vulnerabilities and cyber threats.</p>
                </div>
                <div class="roadmap-card">
                    <h3>UI/UX Design</h3>
                    <p>Learn user-centered design principles and tools to create intuitive, accessible, and beautiful digital experiences.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructors Section -->
    <section id="instructors" class="instructors section">
        <div class="container">
            <h2 class="text-center">Meet Our Expert Instructors</h2>
            <p class="text-center">Learn from industry professionals with years of experience</p>
            <div class="instructor-cards">
                
                <div class="instructor-card">
                    <img src="setemi.jpeg" alt="Michael Chen" class="instructor-img">
                    <div class="instructor-info">
                        <h3>Loye Setemi</h3>
                        <p class="instructor-specialty">Data Science</p>
                        <p>Data Science Lead with expertise in machine learning and AI implementation at scale.</p>
                    </div>
                </div>
                <div class="instructor-card">
                    <img src="mark.jpeg" alt="Aisha Patel" class="instructor-img">
                    <div class="instructor-info">
                        <h3>Mark Zuckerberg</h3>
                        <p class="instructor-specialty">Mobile Development</p>
                        <p>Mobile architect who has shipped apps with millions of downloads on both iOS and Android.</p>
                    </div>
                </div>
                <div class="instructor-card">
                    <img src="coordinator.jpg" alt="James Wilson" class="instructor-img">
                    <div class="instructor-info">
                        <h3>Sarah Johnson</h3>
                        <p class="instructor-specialty">Cloud Computing</p>
                        <p>AWS Certified Solutions Architect with extensive experience in cloud migration strategies.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials section">
        <div class="container">
            <h2 class="text-center">What Our Users Say</h2>
            <div class="testimonial-slider">
                <div class="testimonial-container">
                    <div class="testimonial">
                        <p class="testimonial-content">"TechPathway completely transformed my career journey. The roadmap was clear, resources were relevant, and my instructor's guidance was invaluable. I landed my dream job as a frontend developer within 6 months!"</p>
                        <div class="testimonial-author">
                            <img src="person1.jpeg" alt="Alex Rivera" class="testimonial-avatar">
                            <div>
                                <p class="testimonial-name">Alex Rivera</p>
                                <p class="testimonial-position">Frontend Developer at InnoTech</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial">
                        <p class="testimonial-content">"As someone switching careers from healthcare to tech, I was overwhelmed by where to start. TechPathway's data science roadmap gave me structure and confidence. The community support was amazing!"</p>
                        <div class="testimonial-author">
                            <img src="person3.jpeg" alt="Maya Johnson" class="testimonial-avatar">
                            <div>
                                <p class="testimonial-name">Maya Johnson</p>
                                <p class="testimonial-position">Data Analyst at HealthTech</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial">
                        <p class="testimonial-content">"The 1-on-1 mentoring sessions were game-changers for me. My instructor helped me refine my portfolio and prepare for interviews. Their industry insights were priceless."</p>
                        <div class="testimonial-author">
                            <img src="person2.jpeg" alt="David Kim" class="testimonial-avatar">
                            <div>
                                <p class="testimonial-name">David Kim</p>
                                <p class="testimonial-position">Mobile Developer at AppWorks</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="testimonial-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="testimonial-next"><i class="fas fa-chevron-right"></i></button>
                <div class="testimonial-dots"></div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About TechPathway</h2>
                    <p>TechPathway was founded in 2021 by a team of tech professionals who recognized the challenges faced by aspiring developers, designers, and tech specialists in navigating their career paths.</p>
                    <p>Our mission is to democratize access to tech education and mentorship, creating clear pathways for individuals from all backgrounds to enter and thrive in the technology industry.</p>
                    <p>We believe that with the right guidance, resources, and community support, anyone can build a successful career in technology, regardless of their starting point.</p>
                    <p>Our team consists of industry veterans from leading tech companies who are passionate about sharing their knowledge and helping the next generation of tech talent succeed.</p>
                </div>
                <div class="about-image">
                    <img src="group.jpg" alt="TechPathway team">
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section id="sign-up" class="cta section">
        <div class="container">
            <h2>Ready to Start Your Tech Journey?</h2>
            <p>Join thousands of learners who have successfully launched their tech careers with TechPathway. Sign up today and get access to our roadmaps, resources, and community.</p>
            <a href="LoginPage/index.php" class="btn cta-btn">Sign Up For Free</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <section id="footer">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-col">
                        <h3>TechPathway</h3>
                        <p>Your guide to navigating a successful career in technology.</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h3>Quick Links</h3>
                        <div class="footer-links">
                            <a href="#hero">Home</a>
                            <a href="#features">Features</a>
                            <a href="#roadmaps">Roadmaps</a>
                            <a href="#instructors">Instructors</a>
                            <a href="#about">About Us</a>
                            <a href="#contact">Contact</a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h3>Roadmaps</h3>
                        <div class="footer-links">
                            <a href="#">Web Development</a>
                            <a href="#">Data Science</a>
                            <a href="#">Mobile Development</a>
                            <a href="#">Cloud Computing</a>
                            <a href="#">Cybersecurity</a>
                            <a href="#">UI/UX Design</a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h3>Subscribe</h3>
                        <p>Stay updated with our latest roadmaps and resources.</p>
                        <form class="footer-subscribe">
                            <input type="email" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                    <div class="footer-col">
                        <h3>Get in Touch</h3>
                        <div class="contact-grid">
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p>123 Tech Avenue, San Francisco, CA 94107</p>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <p>info@techpathway.com</p>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <p>+1 (555) 123-4567</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2025 TechPathway. All rights reserved.</p>
                </div>
            </div>
        </section>
    </footer>

    <!-- Scripts -->
    <script src="js/landingscript.js"></script>
</body>
</html>