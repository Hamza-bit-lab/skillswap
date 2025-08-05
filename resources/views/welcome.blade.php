<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>SkillSwap - Exchange Skills, Build Together</title>
</head>

<body>
    <!-- Public Header -->
    <header class="main-header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg main-nav px-0">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-exchange"></i> SkillSwap
                </a>
                
                <!-- Search Bar -->
                <div class="search-container-header">
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search for skills, people, or exchanges...">
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="navbar-nav ml-auto">
                    <a href="#how-it-works" class="nav-link">How It Works</a>
                    <a href="#success-stories" class="nav-link">Success Stories</a>
                    <a href="#community" class="nav-link">Community</a>
                    <a href="#pricing" class="nav-link">Pricing</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="user-menu">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Sign In</a>
                    <a href="{{ route('register.step1') }}" class="btn btn-primary btn-sm">Join SkillSwap</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Exchange Skills,<br>
                        <span class="highlight">Build Together</span>
                    </h1>
                    <p class="hero-description">
                        Connect with talented professionals and exchange your skills. 
                        No money needed - just pure skill collaboration! Build your career 
                        through meaningful skill exchanges.
                    </p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">2,500+</span>
                            <span class="stat-label">Successful Exchanges</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">1,200+</span>
                            <span class="stat-label">Active Members</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">4.8★</span>
                            <span class="stat-label">Average Rating</span>
                        </div>
                    </div>
                    <div class="hero-actions">
                        <a href="{{ route('register.step1') }}" class="btn btn-primary btn-lg">Get Started Free</a>
                        <a href="#how-it-works" class="btn btn-outline-primary btn-lg">Learn How It Works</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <div class="exchange-demo">
                            <div class="user-card left">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="user-avatar">
                                <div class="user-info">
                                    <h4>Sarah Johnson</h4>
                                    <p>Graphic Designer</p>
                                    <div class="skill-tags">
                                        <span class="skill-tag">Logo Design</span>
                                        <span class="skill-tag">Brand Identity</span>
                                    </div>
                                </div>
                            </div>
                            <div class="exchange-arrow">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <div class="user-card right">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                                <div class="user-info">
                                    <h4>Mike Chen</h4>
                                    <p>Web Developer</p>
                                    <div class="skill-tags">
                                        <span class="skill-tag">Website Development</span>
                                        <span class="skill-tag">React</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <div class="section-header text-center">
                <h2>How SkillSwap Works</h2>
                <p>Simple steps to start exchanging skills with professionals worldwide</p>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <h4>Create Profile</h4>
                        <p>Sign up and showcase your skills, experience, and what you need help with.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fa fa-search"></i>
                        </div>
                        <h4>Find Matches</h4>
                        <p>Browse through profiles and find people with complementary skill needs.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fa fa-comments"></i>
                        </div>
                        <h4>Connect & Negotiate</h4>
                        <p>Message potential partners and discuss the terms of your skill exchange.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                        <h4>Exchange Skills</h4>
                        <p>Complete your skill exchange and help each other grow professionally.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Skills Section -->
    <section class="featured-skills">
        <div class="container">
            <div class="section-header text-center">
                <h2>Popular Skill Categories</h2>
                <p>Discover skills that are in high demand for exchanges</p>
            </div>
            
            <div class="skills-grid">
                <div class="skill-category">
                    <div class="skill-icon">
                        <i class="fa fa-code"></i>
                    </div>
                    <h4>Development</h4>
                    <p>Web, Mobile, Backend, Frontend</p>
                    <span class="skill-count">450+ skills</span>
                </div>
                <div class="skill-category">
                    <div class="skill-icon">
                        <i class="fa fa-paint-brush"></i>
                    </div>
                    <h4>Design</h4>
                    <p>UI/UX, Graphic, Logo, Branding</p>
                    <span class="skill-count">380+ skills</span>
                </div>
                <div class="skill-category">
                    <div class="skill-icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                    <h4>Marketing</h4>
                    <p>Digital, Social Media, SEO, Content</p>
                    <span class="skill-count">320+ skills</span>
                </div>
                <div class="skill-category">
                    <div class="skill-icon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <h4>Writing</h4>
                    <p>Content, Copywriting, Blog, Technical</p>
                    <span class="skill-count">280+ skills</span>
                </div>
                <div class="skill-category">
                    <div class="skill-icon">
                        <i class="fa fa-camera"></i>
                    </div>
                    <h4>Photography</h4>
                    <p>Product, Portrait, Event, Editing</p>
                    <span class="skill-count">220+ skills</span>
                </div>
                <div class="skill-category">
                    <div class="skill-icon">
                        <i class="fa fa-video-camera"></i>
                    </div>
                    <h4>Video</h4>
                    <p>Editing, Animation, Motion Graphics</p>
                    <span class="skill-count">180+ skills</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section id="success-stories" class="success-stories">
        <div class="container">
            <div class="section-header text-center">
                <h2>Success Stories</h2>
                <p>Real exchanges that changed careers and built businesses</p>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="story-card">
                        <div class="story-header">
                            <div class="story-users">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User 1" class="story-avatar">
                                <div class="exchange-icon">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User 2" class="story-avatar">
                            </div>
                            <div class="story-title">
                                <h4>"Perfect Skill Match!"</h4>
                                <span class="story-date">Completed 2 weeks ago</span>
                            </div>
                        </div>
                        <div class="story-content">
                            <p>"I needed a website for my photography business, and John needed professional photos for his portfolio. We exchanged skills and both got exactly what we needed! Now I have a beautiful website and John has stunning portfolio photos."</p>
                            <div class="story-tags">
                                <span class="story-tag">Website Development</span>
                                <span class="story-tag">Photography</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="story-card">
                        <div class="story-header">
                            <div class="story-users">
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User 1" class="story-avatar">
                                <div class="exchange-icon">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="User 2" class="story-avatar">
                            </div>
                            <div class="story-title">
                                <h4>"Built My Business Together"</h4>
                                <span class="story-date">Completed 1 month ago</span>
                            </div>
                        </div>
                        <div class="story-content">
                            <p>"Maria helped me with graphic design while I developed her e-commerce website. Now we're both running successful businesses thanks to SkillSwap! The exchange was seamless and professional."</p>
                            <div class="story-tags">
                                <span class="story-tag">Graphic Design</span>
                                <span class="story-tag">E-commerce</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Stats -->
    <section id="community" class="community-stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <i class="fa fa-users"></i>
                        <h3>1,200+</h3>
                        <p>Active Members</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <i class="fa fa-exchange"></i>
                        <h3>2,500+</h3>
                        <p>Successful Exchanges</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <i class="fa fa-star"></i>
                        <h3>4.8</h3>
                        <p>Average Rating</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <i class="fa fa-globe"></i>
                        <h3>50+</h3>
                        <p>Countries</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Simple, Transparent Pricing</h2>
                <p>Join SkillSwap and start exchanging skills today</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3>Free Plan</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">0</span>
                                <span class="period">/month</span>
                            </div>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fa fa-check"></i> Create unlimited skill exchanges</li>
                                <li><i class="fa fa-check"></i> Connect with 5 members per month</li>
                                <li><i class="fa fa-check"></i> Basic profile features</li>
                                <li><i class="fa fa-check"></i> Community support</li>
                            </ul>
                        </div>
                        <div class="pricing-action">
                            <a href="{{ route('register.step1') }}" class="btn btn-outline-primary btn-block">Get Started Free</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="pricing-card featured">
                        <div class="pricing-badge">Most Popular</div>
                        <div class="pricing-header">
                            <h3>Pro Plan</h3>
                            <div class="price">
                                <span class="currency">$</span>
                                <span class="amount">9</span>
                                <span class="period">/month</span>
                            </div>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fa fa-check"></i> Everything in Free</li>
                                <li><i class="fa fa-check"></i> Unlimited connections</li>
                                <li><i class="fa fa-check"></i> Priority support</li>
                                <li><i class="fa fa-check"></i> Advanced analytics</li>
                                <li><i class="fa fa-check"></i> Featured profile</li>
                                <li><i class="fa fa-check"></i> Skill verification badge</li>
                            </ul>
                        </div>
                        <div class="pricing-action">
                            <a href="{{ route('register.step1') }}" class="btn btn-primary btn-block">Start Pro Trial</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container text-center">
            <h2>Ready to Start Your Skill Exchange?</h2>
            <p>Join thousands of professionals who are already exchanging skills and building their careers together.</p>
            <div class="cta-buttons">
                <a href="{{ route('register.step1') }}" class="btn btn-primary btn-lg">Join SkillSwap Free</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Sign In</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h5><i class="fa fa-exchange"></i> SkillSwap</h5>
                    <p>Connecting professionals through skill exchange. Build your career without spending money.</p>
                    <div class="social-links">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h6>Platform</h6>
                    <ul class="footer-links">
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="#success-stories">Success Stories</a></li>
                        <li><a href="#">Safety Guidelines</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6>Community</h6>
                    <ul class="footer-links">
                        <li><a href="#community">Member Directory</a></li>
                        <li><a href="#featured-skills">Skill Categories</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6>Support</h6>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Report Issue</a></li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6>Legal</h6>
                    <ul class="footer-links">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">GDPR</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2024 SkillSwap. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>Made with <i class="fa fa-heart"></i> for the community</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <style>
    /* Global Styles */
    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
        color: #333;
    }

    /* Header Styles */
    .main-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0,0,0,0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 1rem 0;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #14a800 !important;
        text-decoration: none;
    }

    .navbar-brand i {
        margin-right: 0.5rem;
    }

    .search-container-header {
        flex: 1;
        max-width: 400px;
        margin: 0 2rem;
    }

    .search-box {
        position: relative;
        background: #f8f9fa;
        border-radius: 25px;
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
    }

    .search-box i {
        color: #6c757d;
        margin-right: 0.5rem;
    }

    .search-box input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 0.9rem;
    }

    .nav-link {
        color: #495057 !important;
        font-weight: 500;
        margin: 0 1rem;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #14a800 !important;
    }

    .user-menu .btn {
        border-radius: 20px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 120px 0 80px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80') center/cover;
        opacity: 0.1;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-title .highlight {
        background: linear-gradient(45deg, #14a800, #0d7a00);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
        line-height: 1.6;
    }

    .hero-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        display: block;
        font-size: 2rem;
        font-weight: 700;
        color: #14a800;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .hero-actions .btn {
        border-radius: 25px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(20, 168, 0, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(20, 168, 0, 0.4);
    }

    .btn-outline-primary {
        border: 2px solid #14a800;
        color: #14a800;
        background: transparent;
    }

    .btn-outline-primary:hover {
        background: #14a800;
        border-color: #14a800;
        color: white;
    }

    /* Hero Illustration */
    .hero-illustration {
        position: relative;
        z-index: 2;
    }

    .exchange-demo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .user-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        color: #333;
        min-width: 200px;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 3px solid #14a800;
    }

    .user-info h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #14a800;
    }

    .user-info p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .skill-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }

    .skill-tag {
        background: #14a800;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .exchange-arrow {
        font-size: 2rem;
        color: #14a800;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Section Styles */
    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .section-header p {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    /* How It Works Section */
    .how-it-works {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .step-card {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .step-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .step-card h4 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }

    .step-card p {
        color: #6c757d;
        line-height: 1.6;
    }

    /* Featured Skills Section */
    .featured-skills {
        padding: 80px 0;
        background: white;
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .skill-category {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .skill-category:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: #14a800;
    }

    .skill-category .skill-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.8rem;
    }

    .skill-category h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .skill-category p {
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .skill-count {
        background: #e9ecef;
        color: #495057;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Success Stories Section */
    .success-stories {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .story-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        height: 100%;
        transition: all 0.3s ease;
    }

    .story-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .story-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .story-users {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-right: 1rem;
    }

    .story-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid #14a800;
    }

    .exchange-icon {
        color: #14a800;
        font-size: 1.2rem;
    }

    .story-title h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .story-date {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .story-content p {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .story-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .story-tag {
        background: #14a800;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Community Stats Section */
    .community-stats {
        padding: 80px 0;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        color: white;
    }

    .stat-box {
        text-align: center;
        padding: 2rem;
    }

    .stat-box i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    .stat-box h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-box p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Pricing Section */
    .pricing-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .pricing-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
    }

    .pricing-card.featured {
        border: 3px solid #14a800;
        transform: scale(1.05);
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .pricing-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #14a800;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .pricing-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .pricing-header h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }

    .price {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 0.5rem;
    }

    .currency {
        font-size: 1.5rem;
        color: #6c757d;
    }

    .amount {
        font-size: 3rem;
        font-weight: 700;
        color: #14a800;
    }

    .period {
        font-size: 1rem;
        color: #6c757d;
    }

    .pricing-features ul {
        list-style: none;
        padding: 0;
        margin-bottom: 2rem;
    }

    .pricing-features li {
        padding: 0.5rem 0;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pricing-features i {
        color: #14a800;
    }

    .pricing-action .btn {
        border-radius: 25px;
        padding: 1rem 2rem;
        font-weight: 600;
        width: 100%;
    }

    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-align: center;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-section p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cta-buttons .btn {
        border-radius: 25px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Footer */
    .page-footer {
        background: #2c3e50;
        color: white;
        padding: 60px 0 20px;
    }

    .page-footer h5 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #14a800;
    }

    .page-footer h6 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #ecf0f1;
    }

    .page-footer p {
        color: #bdc3c7;
        line-height: 1.6;
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-links a {
        width: 40px;
        height: 40px;
        background: #14a800;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: #0d7a00;
        transform: translateY(-2px);
    }

    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 0.5rem;
    }

    .footer-links a {
        color: #bdc3c7;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #14a800;
    }

    .footer-bottom {
        border-top: 1px solid #34495e;
        padding-top: 20px;
        margin-top: 40px;
    }

    .footer-bottom p {
        margin: 0;
        color: #95a5a6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .exchange-demo {
            flex-direction: column;
            gap: 1rem;
        }

        .user-card {
            min-width: auto;
        }

        .skills-grid {
            grid-template-columns: 1fr;
        }

        .pricing-card.featured {
            transform: none;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .cta-buttons .btn {
            width: 100%;
            max-width: 300px;
        }

        .search-container-header {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            padding: 100px 0 60px;
        }

        .hero-title {
            font-size: 2rem;
        }

        .section-header h2 {
            font-size: 2rem;
        }

        .step-card,
        .skill-category,
        .story-card,
        .pricing-card {
            padding: 1.5rem;
        }
    }
    </style>

</body>

</html>
