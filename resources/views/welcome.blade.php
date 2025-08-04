<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" >
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

</body>

</html>
