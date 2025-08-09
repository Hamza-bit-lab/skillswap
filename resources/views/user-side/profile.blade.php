@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Profile')

@section('content')
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <div class="profile-header-content">
                <div class="profile-avatar-section">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                         alt="{{ $user->name }}" 
                         class="profile-avatar">
                </div>
                <div class="profile-info-section">
                    <h1 class="profile-name">{{ $user->name }}</h1>
                    <p class="profile-username">{{ '@' . $user->username }}</p>
                    <div class="profile-meta">
                        @if($user->location)
                            <span class="meta-item">
                                <i class="fa fa-map-marker"></i>
                                {{ $user->location }}
                            </span>
                        @endif
                        <span class="meta-item">
                            <i class="fa fa-calendar"></i>
                            Joined {{ $user->created_at->format('F Y') }}
                        </span>
                    </div>
                    @php $isOwnProfile = auth()->check() && auth()->id() === $user->id; @endphp
                    <div class="profile-actions">
                        @if($isOwnProfile)
                            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                                Edit Profile
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

    <!-- Profile Stats -->
    <div class="profile-stats">
        <div class="container-fluid">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ number_format($user->getAverageRating(), 1) }}</div>
                    <div class="stat-label">Average Rating</div>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star {{ $i <= $user->getAverageRating() ? 'filled' : '' }}"></i>
                        @endfor
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $user->getTotalExchangesCount() }}</div>
                    <div class="stat-label">Total Exchanges</div>
                    <div class="stat-subtitle">{{ $user->getCompletedExchangesCount() }} completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $skills->count() }}</div>
                    <div class="stat-label">Skills Listed</div>
                    <div class="stat-subtitle">{{ $skills->where('is_verified', true)->count() }} verified</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $portfolioItems->count() }}</div>
                    <div class="stat-label">Portfolio Items</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-main">
        <div class="container-fluid">
            <div class="profile-layout">
                <!-- Left Sidebar -->
                <div class="profile-sidebar">
                    <!-- About Section -->
                     <div class="profile-section">
                        <div class="card-header">
                            <h3 class="section-title">
                                <i class="fa-thin fa-wallet"></i> Plan
                            </h3>
                        </div>
                        <div class="section-content">
                            <p class="about-text">{{ ucfirst($user->plan) }}</p>
                        </div>
                    </div>
                    <div class="profile-section">
                        <div class="card-header">
                            <h3 class="section-title">
                                <i class="fa fa-user"></i> About
                            </h3>
                        </div>
                        <div class="section-content">
                            <p class="about-text">{{ $user->bio ?? 'No bio added yet.' }}</p>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    @if($user->email || $user->phone || $user->website)
                    <div class="profile-section">
                        <div class="card-header">
                            <h3 class="section-title">
                                <i class="fa fa-address-book"></i> Contact
                            </h3>
                        </div>
                        <div class="section-content">
                            <div class="contact-list">
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
                    @endif

                    <!-- Social Links -->
                    @if($user->linkedin || $user->github || $user->twitter)
                    <div class="profile-section">
                        <div class="card-header">
                            <h3 class="section-title">
                                <i class="fa fa-share-alt"></i> Social
                            </h3>
                        </div>
                        <div class="section-content">
                            <div class="social-list">
                                @if($user->linkedin)
                                <a href="{{ $user->linkedin }}" target="_blank" class="social-link">
                                    <i class="fa fa-linkedin"></i>
                                    <span>LinkedIn</span>
                                </a>
                                @endif
                                @if($user->github)
                                <a href="{{ $user->github }}" target="_blank" class="social-link">
                                    <i class="fa fa-github"></i>
                                    <span>GitHub</span>
                                </a>
                                @endif
                                @if($user->twitter)
                                <a href="{{ $user->twitter }}" target="_blank" class="social-link">
                                    <i class="fa fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Skills Section -->
                    <div class="profile-section">
                        <div class="card-header">
                            <h3 class="section-title">
                                <i class="fa fa-cogs"></i> Skills
                            </h3>
                            @if($isOwnProfile)
                                <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#addSkillModal">
                                    Add
                                </button>
                            @endif
                        </div>
                        <div class="section-content">
                            <div class="skills-list">
                                @forelse($skills as $skill)
                                    <div class="skill-item" data-skill-id="{{ $skill->id }}">
                                        <div class="skill-info">
                                            <span class="skill-name">{{ $skill->name }}</span>
                                            <span class="skill-level">{{ $skill->level }}</span>
                                            @if($skill->is_verified)
                                                <i class="fa fa-check verified-badge" title="Verified"></i>
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
                <div class="profile-content">
                    <!-- Navigation Tabs -->
                    <div class="content-tabs">
                        <div class="tab-nav">
                            <button class="tab-btn active" data-tab="exchanges">
                                Exchanges <span class="tab-count">{{ $exchanges->count() }}</span>
                            </button>
                            <button class="tab-btn" data-tab="reviews">
                                Reviews <span class="tab-count">{{ $reviews->count() }}</span>
                            </button>
                            <button class="tab-btn" data-tab="portfolio">
                                Portfolio <span class="tab-count">{{ $portfolioItems->count() }}</span>
                            </button>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Exchanges Tab -->
                            <div class="tab-pane active" id="exchanges">
                                <div class="content-list">
                                    @forelse($exchanges as $exchange)
                                        <div class="content-item">
                                            <div class="item-header">
                                                <div class="item-title">{{ $exchange->title ?? 'Skill Exchange' }}</div>
                                                <div class="item-status status-{{ $exchange->status }}">
                                                    {{ ucfirst($exchange->status) }}
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <p>{{ $exchange->description ?? 'No description provided' }}</p>
                                                <div class="item-meta">
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
                            <div class="tab-pane" id="reviews">
                                <div class="content-list">
                                    @forelse($reviews as $review)
                                        <div class="content-item">
                                            <div class="item-header">
                                                <div class="reviewer-info">
                                                    <img src="{{ asset('assets/images/default-avatar.jpg') }}" 
                                                         alt="Reviewer" class="reviewer-avatar">
                                                    <div>
                                                        <div class="reviewer-name">{{ $review->reviewer->name }}</div>
                                                        <div class="review-rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review-date">
                                                    {{ $review->created_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <h5>{{ $review->title }}</h5>
                                                <p>{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-state">
                                            <h4>No Reviews Yet</h4>
                                            <p>Complete exchanges to start receiving reviews from other users.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Portfolio Tab -->
                            <div class="tab-pane" id="portfolio">
                                <div class="portfolio-header">
                                    <h3>Portfolio</h3>
                                    @if($isOwnProfile)
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPortfolioModal">
                                            Add Item
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
                                                <h5>{{ $item->title }}</h5>
                                                <p>{{ Str::limit($item->description, 60) }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-state">
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
/* Base Styles */
.profile-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

/* Profile Header */
.profile-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    border-bottom: 1px solid #e9ecef;
    padding: 40px 0;
    color: #fff;
}

.profile-header-content {
    display: flex;
    align-items: center;
    gap: 30px;
}

.profile-avatar-section {
    flex-shrink: 0;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.profile-info-section {
    flex: 1;
}

.profile-name {
    font-size: 2rem;
    font-weight: 600;
    color: #fff;
    margin: 0 0 5px 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.profile-username {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9);
    margin: 0 0 15px 0;
}

.profile-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
}

.meta-item i {
    width: 14px;
}

.profile-actions {
    margin-top: 15px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn-primary {
    background: #4B9CD3;
    border-color: #4B9CD3;
    padding: 8px 16px;
    font-size: 0.9rem;
}

.btn-primary:hover {
    background: #3a7bb3;
    border-color: #3a7bb3;
}

.btn-outline-primary {
    color: #4B9CD3;
    border-color: #4B9CD3;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #4B9CD3;
    border-color: #4B9CD3;
    color: #fff;
}

.btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
    background: transparent;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    color: #fff;
}

/* Profile Stats */
.profile-stats {
    background: #fff;
    padding: 30px 0;
    border-bottom: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    border-radius: 8px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(75, 156, 211, 0.2);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #4B9CD3;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.stat-subtitle {
    font-size: 0.8rem;
    color: #28a745;
}

.rating-stars {
    margin-top: 8px;
}

.rating-stars .fa-star {
    color: #dee2e6;
    font-size: 0.8rem;
}

.rating-stars .fa-star.filled {
    color: #ffc107;
}

/* Main Content */
.profile-main {
    padding: 40px 0;
}

.profile-layout {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 40px;
}

/* Sidebar */
.profile-sidebar {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.profile-section {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.profile-section:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 156, 211, 0.15);
}

.card-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
    padding: 20px;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-title i {
    width: 16px;
}

.btn-outline-light {
    color: #fff;
    border-color: #fff;
    background: transparent;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8rem;
    transition: all 0.2s ease;
}

.btn-outline-light:hover {
    background: #fff;
    color: #4B9CD3;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.section-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 15px 0;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 8px;
}

.section-content {
    color: #6c757d;
    padding: 25px;
}

.about-text {
    line-height: 1.6;
    margin: 0;
}

/* Contact List */
.contact-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
}

.contact-item i {
    width: 16px;
    color: #6c757d;
}

.contact-item a {
    color: #4B9CD3;
    text-decoration: none;
}

.contact-item a:hover {
    text-decoration: underline;
}

/* Social List */
.social-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 6px;
    text-decoration: none;
    color: #6c757d;
    transition: all 0.2s ease;
    border: 1px solid #e9ecef;
}

.social-link:hover {
    background: #4B9CD3;
    color: #fff;
    text-decoration: none;
    transform: translateX(3px);
}

/* Skills List */
.skills-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.skill-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-radius: 6px;
    border-left: 3px solid #4B9CD3;
    transition: all 0.2s ease;
}

.skill-item:hover {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    transform: translateX(3px);
    box-shadow: 0 2px 8px rgba(75, 156, 211, 0.15);
}

.skill-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.skill-name {
    font-weight: 500;
    color: #212529;
}

.skill-level {
    font-size: 0.8rem;
    padding: 2px 8px;
    border-radius: 12px;
    background: #e9ecef;
    color: #6c757d;
}

.verified-badge {
    color: #28a745;
    font-size: 0.8rem;
}

.skill-actions {
    display: flex;
    gap: 5px;
}

.skill-actions .btn-link {
    padding: 2px 6px;
    color: #6c757d;
}

.skill-actions .btn-link:hover {
    color: #dc3545;
}

/* Content Area */
.profile-content {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e9ecef;
}

/* Tab Navigation */
.content-tabs {
    border-bottom: 1px solid #e9ecef;
}

.tab-nav {
    display: flex;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #e9ecef;
}

.tab-btn {
    flex: 1;
    padding: 15px 20px;
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    color: #6c757d;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.tab-btn:hover {
    background: #e9ecef;
    color: #495057;
}

.tab-btn.active {
    color: #4B9CD3;
    border-bottom-color: #4B9CD3;
    background: #fff;
}

.tab-count {
    background: #6c757d;
    color: #fff;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 0.7rem;
    margin-left: 5px;
}

.tab-btn.active .tab-count {
    background: #4B9CD3;
}

/* Tab Content */
.tab-content {
    padding: 30px;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

/* Content Lists */
.content-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.content-item {
    padding: 20px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    transition: all 0.2s ease;
}

.content-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 156, 211, 0.15);
    border-color: #4B9CD3;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.item-title {
    font-weight: 600;
    color: #212529;
    font-size: 1.1rem;
}

.item-status {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-in_progress { background: #cce5ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

.item-content p {
    color: #6c757d;
    margin: 0 0 15px 0;
    line-height: 1.5;
}

.item-meta {
    display: flex;
    gap: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8rem;
    color: white;
}

/* Review Items */
.reviewer-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.reviewer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.reviewer-name {
    font-weight: 600;
    color: #212529;
    margin-bottom: 2px;
}

.review-rating {
    display: flex;
    gap: 2px;
}

.review-rating .fa-star {
    font-size: 0.8rem;
    color: #dee2e6;
}

.review-rating .fa-star.filled {
    color: #ffc107;
}

.review-date {
    color: #6c757d;
    font-size: 0.8rem;
}

.item-content h5 {
    margin: 0 0 10px 0;
    color: #212529;
    font-weight: 600;
}

/* Portfolio */
.portfolio-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.portfolio-header h3 {
    margin: 0;
    color: #212529;
}

.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.portfolio-item {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    transition: all 0.2s ease;
}

.portfolio-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(75, 156, 211, 0.2);
    border-color: #4B9CD3;
}

.portfolio-image {
    position: relative;
    height: 180px;
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
    background: rgba(75, 156, 211, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.2s;
}

.portfolio-item:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-content {
    padding: 15px;
}

.portfolio-content h5 {
    margin: 0 0 8px 0;
    font-weight: 600;
    color: #212529;
}

.portfolio-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state h4 {
    color: #212529;
    margin-bottom: 10px;
}

.empty-state p {
    margin-bottom: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-meta {
        justify-content: center;
    }
    
    .profile-layout {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .tab-nav {
        flex-direction: column;
    }
    
    .tab-btn {
        border-bottom: none;
        border-left: 2px solid transparent;
    }
    
         .tab-btn.active {
         border-left-color: #4B9CD3;
         border-bottom-color: transparent;
     }
    
    .portfolio-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .profile-avatar {
        width: 100px;
        height: 100px;
    }
    
    .profile-name {
        font-size: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .tab-content {
        padding: 20px;
    }
}
</style>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });

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
                    window.location.href = `/dashboard/profile/portfolio/${itemId}`;
                }
            });
        });
    });
});
</script>