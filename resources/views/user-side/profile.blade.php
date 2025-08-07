@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Profile')

@section('content')
<div class="profile-container">
    <!-- Profile Cover & Header -->
    <div class="profile-cover-section">
        <div class="cover-image">
            <div class="cover-overlay"></div>
        </div>
        
        <div class="profile-header-content">
            <div class="container-fluid">
                <div class="row align-items-end">
                    <div class="col-auto">
                        <!-- Profile Avatar -->
                        <div class="profile-avatar-container">
                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                 alt="{{ $user->name }}" 
                                 class="profile-avatar">
                            <div class="avatar-status-indicator online"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="profile-info">
                            <h1 class="profile-name">{{ $user->name }}</h1>
                            <p class="profile-username">{{ '@' . $user->username }}</p>
                            <div class="profile-meta">
                                <span class="meta-item">
                                    <i class="fa fa-map-marker"></i>
                                    {{ $user->location ?? 'Location not set' }}
                                </span>
                                <span class="meta-item">
                                    <i class="fa fa-calendar"></i>
                                    Joined {{ $user->created_at->format('F Y') }}
                                </span>
                                <span class="meta-item">
                                    <i class="fa fa-clock-o"></i>
                                    Last active {{ $user->last_active ? $user->last_active->diffForHumans() : 'Recently' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="profile-actions">
                            @php $isOwnProfile = auth()->check() && auth()->id() === $user->id; @endphp
                            @if($isOwnProfile)
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                                    <i class="fa fa-pencil"></i> Edit Profile
                                </a>
                            @endif
                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#shareProfileModal">
                                <i class="fa fa-share"></i> Share
                            </button>
                            <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ url('/profile/' . $user->username) }}'); alert('Profile link copied!')">
                                <i class="fa fa-link"></i> Copy Profile Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Stats -->
    <div class="profile-stats-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ number_format($user->getAverageRating(), 1) }}</h3>
                            <p>Average Rating</p>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $user->getAverageRating() ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $user->getTotalExchangesCount() }}</h3>
                            <p>Total Exchanges</p>
                            <small class="text-success">{{ $user->getCompletedExchangesCount() }} completed</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-cogs"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $skills->count() }}</h3>
                            <p>Skills Listed</p>
                            <small class="text-info">{{ $skills->where('is_verified', true)->count() }} verified</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-folder"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $portfolioItems->count() }}</h3>
                            <p>Portfolio Items</p>
                            <small class="text-primary">Showcase work</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-main-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-lg-4">
                    <!-- About Section -->
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-user"></i> About Me</h5>
                            <button class="btn btn-sm btn-link" data-toggle="modal" data-target="#editAboutModal">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <p class="about-text">{{ $user->bio ?? 'No bio added yet. Tell others about yourself, your interests, and what you\'re passionate about!' }}</p>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-address-book"></i> Contact Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="contact-info">
                                @if($user->email)
                                <div class="contact-item">
                                    <i class="fa fa-envelope"></i>
                                    <span>{{ $user->email }}</span>
                                </div>
                                @endif
                                @if($user->phone)
                                <div class="contact-item">
                                    <i class="fa fa-phone"></i>
                                    <span>{{ $user->phone }}</span>
                                </div>
                                @endif
                                @if($user->website)
                                <div class="contact-item">
                                    <i class="fa fa-globe"></i>
                                    <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    @if($user->linkedin || $user->github || $user->twitter)
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-share-alt"></i> Social Links</h5>
                        </div>
                        <div class="card-body">
                            <div class="social-links">
                                @if($user->linkedin)
                                <a href="{{ $user->linkedin }}" target="_blank" class="social-link linkedin">
                                    <i class="fa fa-linkedin"></i>
                                    <span>LinkedIn</span>
                                </a>
                                @endif
                                @if($user->github)
                                <a href="{{ $user->github }}" target="_blank" class="social-link github">
                                    <i class="fa fa-github"></i>
                                    <span>GitHub</span>
                                </a>
                                @endif
                                @if($user->twitter)
                                <a href="{{ $user->twitter }}" target="_blank" class="social-link twitter">
                                    <i class="fa fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Skills Section -->
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-cogs"></i> My Skills</h5>
                            @if($isOwnProfile)
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSkillModal">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="skills-container">
                                @forelse($skills as $skill)
                                    <div class="skill-tag" data-skill-id="{{ $skill->id }}">
                                        <div class="skill-info">
                                            <span class="skill-name">{{ $skill->name }}</span>
                                            <span class="skill-level level-{{ strtolower($skill->level) }}">{{ $skill->level }}</span>
                                            @if($skill->is_verified)
                                                <i class="fa fa-check-circle verified-badge" title="Verified Skill"></i>
                                            @endif
                                        </div>
                                        @if($isOwnProfile)
                                            <div class="skill-actions">
                                                <button class="btn btn-sm btn-link edit-skill" data-skill-id="{{ $skill->id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-link delete-skill" data-skill-id="{{ $skill->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fa fa-cogs"></i>
                                        <p>No skills added yet</p>
                                        @if($isOwnProfile)
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSkillModal">
                                                Add Your First Skill
                                            </button>
                                        @endif
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="col-lg-8">
                    <!-- Navigation Tabs -->
                    <div class="profile-tabs">
                        <ul class="nav nav-pills" id="profileTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="exchanges-tab" data-toggle="pill" href="#exchanges" role="tab">
                                    <i class="fa fa-exchange"></i> Exchanges <span class="badge badge-primary">{{ $exchanges->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="pill" href="#reviews" role="tab">
                                    <i class="fa fa-star"></i> Reviews <span class="badge badge-warning">{{ $reviews->count() }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="portfolio-tab" data-toggle="pill" href="#portfolio" role="tab">
                                    <i class="fa fa-folder"></i> Portfolio <span class="badge badge-info">{{ $portfolioItems->count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content profile-tab-content" id="profileTabsContent">
                        <!-- Exchanges Tab -->
                        <div class="tab-pane fade show active" id="exchanges" role="tabpanel">
                            <div class="exchanges-section">
                                @forelse($exchanges as $exchange)
                                    <div class="exchange-card">
                                        <div class="exchange-header">
                                            <div class="exchange-users">
                                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                                     alt="{{ $user->name }}" class="user-avatar">
                                                <div class="exchange-arrow">
                                                    <i class="fa fa-exchange"></i>
                                                </div>
                                                <img src="{{ asset('assets/images/default-avatar.jpg') }}" 
                                                     alt="Partner" class="user-avatar">
                                            </div>
                                            <div class="exchange-status">
                                                <span class="status-badge status-{{ $exchange->status }}">{{ ucfirst($exchange->status) }}</span>
                                            </div>
                                        </div>
                                        <div class="exchange-content">
                                            <h5>{{ $exchange->title ?? 'Skill Exchange' }}</h5>
                                            <p>{{ $exchange->description ?? 'No description provided' }}</p>
                                            <div class="exchange-meta">
                                                <span class="meta-item">
                                                    <i class="fa fa-calendar"></i>
                                                    {{ $exchange->created_at->format('M d, Y') }}
                                                </span>
                                                @if($exchange->estimated_hours)
                                                <span class="meta-item">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $exchange->estimated_hours }} hours
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fa fa-exchange"></i>
                                        <h4>No Exchanges Yet</h4>
                                        <p>Start your first skill exchange to build your reputation!</p>
                                        <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary">
                                            Find Exchanges
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="reviews-section">
                                @forelse($reviews as $review)
                                    <div class="review-card">
                                        <div class="review-header">
                                            <img src="{{ asset('assets/images/default-avatar.jpg') }}" 
                                                 alt="Reviewer" class="reviewer-avatar">
                                            <div class="reviewer-info">
                                                <h6>{{ $review->reviewer->name }}</h6>
                                                <div class="review-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="review-date">
                                                {{ $review->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <h6>{{ $review->title }}</h6>
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fa fa-star"></i>
                                        <h4>No Reviews Yet</h4>
                                        <p>Complete exchanges to start receiving reviews from other users.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Portfolio Tab -->
                        <div class="tab-pane fade" id="portfolio" role="tabpanel">
                            <div class="portfolio-section">
                                <div class="portfolio-header">
                                    <h4>My Portfolio</h4>
                                    @if($isOwnProfile)
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPortfolioModal">
                                            <i class="fa fa-plus"></i> Add Item
                                        </button>
                                    @endif
                                </div>
                                <div class="portfolio-grid">
                                    @forelse($portfolioItems as $item)
                                        <div class="portfolio-item">
                                            <div class="portfolio-image">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                                <div class="portfolio-overlay">
                                                    <button class="btn btn-sm btn-light view-portfolio" data-item-id="{{ $item->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    @if($isOwnProfile)
                                                        <button class="btn btn-sm btn-danger delete-portfolio" data-item-id="{{ $item->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="portfolio-content">
                                                <h6>{{ $item->title }}</h6>
                                                <p>{{ Str::limit($item->description, 60) }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-state">
                                            <i class="fa fa-folder"></i>
                                            <h4>No Portfolio Items</h4>
                                            <p>Showcase your work by adding portfolio items.</p>
                                            @if($isOwnProfile)
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#addPortfolioModal">
                                                    Add Your First Item
                                                </button>
                                            @endif
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Profile Container */
.profile-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 0;
}

/* Cover Section */
.profile-cover-section {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 40px;
    margin-bottom: 30px;
}

.cover-image {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80') center/cover;
}

.cover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
}

.profile-header-content {
    position: relative;
    z-index: 2;
}

/* Profile Avatar */
.profile-avatar-container {
    position: relative;
    margin-bottom: 20px;
}

.profile-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 5px solid #fff;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    object-fit: cover;
    background: #fff;
}

.avatar-status-indicator {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid #fff;
}

.avatar-status-indicator.online {
    background: #28a745;
}

/* Profile Info */
.profile-info {
    color: #fff;
}

.profile-name {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.profile-username {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 5px 0 15px;
}

.profile-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    opacity: 0.9;
}

.meta-item i {
    width: 16px;
}

/* Profile Actions */
.profile-actions {
    display: flex;
    gap: 10px;
}

.profile-actions .btn {
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: 600;
}

/* Stats Section */
.profile-stats-section {
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #fff;
    font-size: 24px;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: #333;
}

.stat-content p {
    color: #666;
    margin: 5px 0;
    font-weight: 500;
}

/* Main Content */
.profile-main-content {
    background: #f8f9fa;
    min-height: 60vh;
    padding: 30px 0;
}

/* Profile Cards */
.profile-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
}

.profile-card .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 20px;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-card .card-header h5 {
    margin: 0;
    font-weight: 600;
}

.profile-card .card-body {
    padding: 25px;
}

/* Contact Info */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
}

.contact-item i {
    width: 20px;
    color: #667eea;
}

/* Social Links */
.social-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link.linkedin {
    background: #0077b5;
    color: #fff;
}

.social-link.github {
    background: #333;
    color: #fff;
}

.social-link.twitter {
    background: #1da1f2;
    color: #fff;
}

.social-link:hover {
    transform: translateX(5px);
    text-decoration: none;
    color: #fff;
}

/* Skills */
.skills-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.skill-tag {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
}

.skill-tag:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.skill-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.skill-name {
    font-weight: 600;
    color: #333;
}

.skill-level {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.level-beginner { background: #d4edda; color: #155724; }
.level-intermediate { background: #fff3cd; color: #856404; }
.level-advanced { background: #cce5ff; color: #004085; }
.level-expert { background: #f8d7da; color: #721c24; }

.verified-badge {
    color: #28a745;
}

/* Profile Tabs */
.profile-tabs {
    margin-bottom: 30px;
}

.profile-tabs .nav-pills .nav-link {
    border-radius: 25px;
    padding: 12px 20px;
    margin-right: 10px;
    background: #fff;
    color: #667eea;
    border: 2px solid #667eea;
    font-weight: 600;
    transition: all 0.3s ease;
}

.profile-tabs .nav-pills .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-color: transparent;
}

.profile-tabs .badge {
    margin-left: 8px;
}

/* Tab Content */
.profile-tab-content {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* Exchange Cards */
.exchange-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 4px solid #667eea;
}

.exchange-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.exchange-users {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.exchange-arrow {
    color: #667eea;
    font-size: 18px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-in_progress { background: #cce5ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

/* Review Cards */
.review-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
}

.review-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.reviewer-info h6 {
    margin: 0;
    font-weight: 600;
}

.review-date {
    margin-left: auto;
    color: #666;
    font-size: 0.9rem;
}

/* Portfolio Grid */
.portfolio-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.portfolio-item {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.portfolio-item:hover {
    transform: translateY(-5px);
}

.portfolio-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.portfolio-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.portfolio-item:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-content {
    padding: 15px;
}

.portfolio-content h6 {
    margin: 0 0 8px;
    font-weight: 600;
    color: #333;
}

.portfolio-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-state i {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #333;
    margin-bottom: 10px;
}

.empty-state p {
    margin-bottom: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-name {
        font-size: 2rem;
    }
    
    .profile-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .profile-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .profile-actions .btn {
        width: 100%;
    }
    
    .stat-card {
        margin-bottom: 20px;
    }
    
    .portfolio-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-tabs .nav-pills {
        flex-direction: column;
    }
    
    .profile-tabs .nav-pills .nav-link {
        margin-right: 0;
        margin-bottom: 10px;
    }
}

@media (max-width: 576px) {
    .profile-avatar {
        width: 120px;
        height: 120px;
    }
    
    .profile-cover-section {
        padding: 40px 0 30px;
    }
    
    .profile-tab-content {
        padding: 20px;
    }
}
</style>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete Skill
    document.querySelectorAll('.delete-skill').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const skillId = btn.getAttribute('data-skill-id');
            Swal.fire({
                title: 'Delete Skill?',
                text: 'Are you sure you want to delete this skill? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // You may want to submit a form or make an AJAX request here
                    window.location.href = `/dashboard/profile/skills/${skillId}`;
                }
            });
        });
    });
    // Delete Portfolio Item
    document.querySelectorAll('.delete-portfolio').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const itemId = btn.getAttribute('data-item-id');
            Swal.fire({
                title: 'Delete Portfolio Item?',
                text: 'Are you sure you want to delete this portfolio item? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // You may want to submit a form or make an AJAX request here
                    window.location.href = `/dashboard/profile/portfolio/${itemId}`;
                }
            });
        });
    });
});
</script>