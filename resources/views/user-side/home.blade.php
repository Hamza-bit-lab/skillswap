@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Exchange Skills, Build Together')

@section('content')
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
                    No money needed - just pure skill collaboration!
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

<!-- Search Section -->
<div class="search-section">
    <div class="container">
        <div class="search-box-large">
            <h3>Find Your Perfect Skill Match</h3>
            <div class="search-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>What skill do you need?</label>
                            <input type="text" class="form-control" placeholder="e.g., Website Development, Logo Design">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>What skill can you offer?</label>
                            <input type="text" class="form-control" placeholder="e.g., Graphic Design, Content Writing">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Location (Optional)</label>
                            <input type="text" class="form-control" placeholder="City, Country">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-lg search-btn">
                        <i class="fa fa-search"></i> Find Skill Matches
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Skill Exchanges -->
<section class="featured-exchanges">
    <div class="container">
        <div class="section-header">
            <h2>Featured Skill Exchanges</h2>
            <p>Discover amazing skill exchanges happening in our community</p>
        </div>
        
        <div class="filters">
            <button class="filter-btn active">All Skills</button>
            <button class="filter-btn">Design</button>
            <button class="filter-btn">Development</button>
            <button class="filter-btn">Marketing</button>
            <button class="filter-btn">Writing</button>
            <button class="filter-btn">Photography</button>
        </div>

        <div class="exchanges-grid">
            <!-- Exchange Card 1 -->
            <div class="exchange-card">
                <div class="exchange-header">
                    <div class="user-info">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="user-avatar">
                        <div>
                            <h5>Sarah Johnson</h5>
                            <span class="user-location"><i class="fa fa-map-marker"></i> New York, USA</span>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>(12 exchanges)</span>
                            </div>
                        </div>
                    </div>
                    <div class="exchange-status active">Available</div>
                </div>
                
                <div class="exchange-details">
                    <div class="skill-need">
                        <h6><i class="fa fa-search"></i> Looking for:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Website Development</span>
                            <span class="skill-tag">React</span>
                        </div>
                    </div>
                    <div class="skill-offer">
                        <h6><i class="fa fa-gift"></i> Offering:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Logo Design</span>
                            <span class="skill-tag">Brand Identity</span>
                            <span class="skill-tag">UI/UX Design</span>
                        </div>
                    </div>
                </div>
                
                <div class="exchange-description">
                    <p>I'm a graphic designer looking to build my portfolio website. I can help with logo design, brand identity, and UI/UX design in exchange for website development.</p>
                </div>
                
                <div class="exchange-actions">
                    <button class="btn btn-outline-primary btn-sm">View Profile</button>
                    <button class="btn btn-primary btn-sm">Start Exchange</button>
                </div>
            </div>

            <!-- Exchange Card 2 -->
            <div class="exchange-card">
                <div class="exchange-header">
                    <div class="user-info">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                        <div>
                            <h5>Mike Chen</h5>
                            <span class="user-location"><i class="fa fa-map-marker"></i> San Francisco, USA</span>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>(8 exchanges)</span>
                            </div>
                        </div>
                    </div>
                    <div class="exchange-status active">Available</div>
                </div>
                
                <div class="exchange-details">
                    <div class="skill-need">
                        <h6><i class="fa fa-search"></i> Looking for:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Content Writing</span>
                            <span class="skill-tag">Blog Posts</span>
                        </div>
                    </div>
                    <div class="skill-offer">
                        <h6><i class="fa fa-gift"></i> Offering:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">SEO Optimization</span>
                            <span class="skill-tag">Digital Marketing</span>
                            <span class="skill-tag">Google Ads</span>
                        </div>
                    </div>
                </div>
                
                <div class="exchange-description">
                    <p>Web developer seeking content for my tech blog. I can help with SEO optimization, digital marketing, and Google Ads management in exchange for quality content writing.</p>
                </div>
                
                <div class="exchange-actions">
                    <button class="btn btn-outline-primary btn-sm">View Profile</button>
                    <button class="btn btn-primary btn-sm">Start Exchange</button>
                </div>
            </div>

            <!-- Exchange Card 3 -->
            <div class="exchange-card">
                <div class="exchange-header">
                    <div class="user-info">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User" class="user-avatar">
                        <div>
                            <h5>Emma Davis</h5>
                            <span class="user-location"><i class="fa fa-map-marker"></i> London, UK</span>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>(15 exchanges)</span>
                            </div>
                        </div>
                    </div>
                    <div class="exchange-status active">Available</div>
                </div>
                
                <div class="exchange-details">
                    <div class="skill-need">
                        <h6><i class="fa fa-search"></i> Looking for:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Social Media Management</span>
                            <span class="skill-tag">Instagram</span>
                        </div>
                    </div>
                    <div class="skill-offer">
                        <h6><i class="fa fa-gift"></i> Offering:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Photography</span>
                            <span class="skill-tag">Video Editing</span>
                            <span class="skill-tag">Adobe Premiere</span>
                        </div>
                    </div>
                </div>
                
                <div class="exchange-description">
                    <p>Photographer looking for social media management for my photography business. I can provide professional photography and video editing services in exchange.</p>
                </div>
                
                <div class="exchange-actions">
                    <button class="btn btn-outline-primary btn-sm">View Profile</button>
                    <button class="btn btn-primary btn-sm">Start Exchange</button>
                </div>
            </div>

            <!-- Exchange Card 4 -->
            <div class="exchange-card">
                <div class="exchange-header">
                    <div class="user-info">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="user-avatar">
                        <div>
                            <h5>Alex Rodriguez</h5>
                            <span class="user-location"><i class="fa fa-map-marker"></i> Toronto, Canada</span>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>(20 exchanges)</span>
                            </div>
                        </div>
                    </div>
                    <div class="exchange-status active">Available</div>
                </div>
                
                <div class="exchange-details">
                    <div class="skill-need">
                        <h6><i class="fa fa-search"></i> Looking for:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Mobile App Development</span>
                            <span class="skill-tag">React Native</span>
                        </div>
                    </div>
                    <div class="skill-offer">
                        <h6><i class="fa fa-gift"></i> Offering:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Backend Development</span>
                            <span class="skill-tag">Node.js</span>
                            <span class="skill-tag">Database Design</span>
                        </div>
                    </div>
                </div>
                
                <div class="exchange-description">
                    <p>Backend developer seeking mobile app development for my startup. I can handle all backend development, API creation, and database design in exchange.</p>
                </div>
                
                <div class="exchange-actions">
                    <button class="btn btn-outline-primary btn-sm">View Profile</button>
                    <button class="btn btn-primary btn-sm">Start Exchange</button>
                </div>
            </div>

            <!-- Exchange Card 5 -->
            <div class="exchange-card">
                <div class="exchange-header">
                    <div class="user-info">
                        <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="User" class="user-avatar">
                        <div>
                            <h5>Maria Garcia</h5>
                            <span class="user-location"><i class="fa fa-map-marker"></i> Madrid, Spain</span>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>(6 exchanges)</span>
                            </div>
                        </div>
                    </div>
                    <div class="exchange-status active">Available</div>
                </div>
                
                <div class="exchange-details">
                    <div class="skill-need">
                        <h6><i class="fa fa-search"></i> Looking for:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">E-commerce Website</span>
                            <span class="skill-tag">Shopify</span>
                        </div>
                    </div>
                    <div class="skill-offer">
                        <h6><i class="fa fa-gift"></i> Offering:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Product Photography</span>
                            <span class="skill-tag">Copywriting</span>
                            <span class="skill-tag">Email Marketing</span>
                        </div>
                    </div>
                </div>
                
                <div class="exchange-description">
                    <p>Product photographer and copywriter looking for e-commerce website development. I can provide professional product photography, copywriting, and email marketing services.</p>
                </div>
                
                <div class="exchange-actions">
                    <button class="btn btn-outline-primary btn-sm">View Profile</button>
                    <button class="btn btn-primary btn-sm">Start Exchange</button>
                </div>
            </div>

            <!-- Exchange Card 6 -->
            <div class="exchange-card">
                <div class="exchange-header">
                    <div class="user-info">
                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="User" class="user-avatar">
                        <div>
                            <h5>David Kim</h5>
                            <span class="user-location"><i class="fa fa-map-marker"></i> Seoul, South Korea</span>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>(18 exchanges)</span>
                            </div>
                        </div>
                    </div>
                    <div class="exchange-status active">Available</div>
                </div>
                
                <div class="exchange-details">
                    <div class="skill-need">
                        <h6><i class="fa fa-search"></i> Looking for:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">UI/UX Design</span>
                            <span class="skill-tag">Figma</span>
                        </div>
                    </div>
                    <div class="skill-offer">
                        <h6><i class="fa fa-gift"></i> Offering:</h6>
                        <div class="skill-tags">
                            <span class="skill-tag">Data Analysis</span>
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">Machine Learning</span>
                        </div>
                    </div>
                </div>
                
                <div class="exchange-description">
                    <p>Data scientist seeking UI/UX design for my analytics dashboard. I can help with data analysis, Python development, and machine learning in exchange for design work.</p>
                </div>
                
                <div class="exchange-actions">
                    <button class="btn btn-outline-primary btn-sm">View Profile</button>
                    <button class="btn btn-primary btn-sm">Start Exchange</button>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button class="btn btn-outline-primary btn-lg">Load More Exchanges</button>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works">
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

<!-- Success Stories -->
<section class="success-stories">
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
<section class="community-stats">
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

<!-- Call to Action -->
<section class="cta-section">
    <div class="container text-center">
        <h2>Ready to Start Your Skill Exchange?</h2>
        <p>Join thousands of professionals who are already exchanging skills and building their careers together.</p>
        <div class="cta-buttons">
            <button class="btn btn-primary btn-lg">Join SkillSwap</button>
            <button class="btn btn-outline-primary btn-lg">Learn More</button>
        </div>
    </div>
</section>
@endsection 