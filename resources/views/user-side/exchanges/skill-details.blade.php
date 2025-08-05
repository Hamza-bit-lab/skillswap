@extends('user-side.layouts.app')

@section('title', 'SkillSwap - ' . $skill->name)

@section('content')
<div class="skill-details-container">
    <!-- Header Section -->
    <div class="skill-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="skill-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="skill-info">
                            <div class="skill-badges">
                                @if($skill->is_featured)
                                    <span class="badge badge-featured">
                                        <i class="fa fa-star"></i> Featured Skill
                                    </span>
                                @endif
                                <span class="badge badge-level level-{{ strtolower($skill->level) }}">
                                    {{ $skill->level }}
                                </span>
                            </div>
                            <h1 class="skill-title">{{ $skill->name }}</h1>
                            <p class="skill-subtitle">{{ $skill->description }}</p>
                            <div class="skill-meta">
                                <span class="meta-item">
                                    <i class="fa fa-tags"></i> {{ $skill->category }}
                                </span>
                                @if($skill->experience_years)
                                <span class="meta-item">
                                    <i class="fa fa-clock-o"></i> {{ $skill->experience_years }} years experience
                                </span>
                                @endif
                                <span class="meta-item">
                                    <i class="fa fa-star"></i> {{ number_format($skill->getAverageRating(), 1) }} rating
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="skill-actions">
                            @if($existingExchange)
                                <div class="existing-exchange-alert">
                                    <i class="fa fa-info-circle"></i>
                                    <span>You already have an active exchange with this user</span>
                                    <a href="{{ route('user.exchanges.show', $existingExchange->id) }}" class="btn btn-primary btn-sm">
                                        View Exchange
                                    </a>
                                </div>
                            @else
                                <button class="btn btn-primary btn-lg" onclick="showExchangeModal()">
                                    <i class="fa fa-exchange"></i> Start Exchange
                                </button>
                                <button class="btn btn-outline-primary btn-lg" onclick="showContactModal()">
                                    <i class="fa fa-envelope"></i> Contact User
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="skill-main-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Skill Details -->
                <div class="col-lg-8">
                    <!-- Skill Owner Card -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3><i class="fa fa-user"></i> Skill Owner</h3>
                        </div>
                        <div class="card-body">
                            <div class="skill-owner">
                                <div class="owner-avatar">
                                    <img src="{{ $skill->user->avatar ? asset('storage/' . $skill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                         alt="{{ $skill->user->name }}">
                                </div>
                                <div class="owner-info">
                                    <h4>{{ $skill->user->name }}</h4>
                                    <p class="owner-bio">{{ $skill->user->bio ?? 'No bio available' }}</p>
                                    <div class="owner-meta">
                                        <span class="meta-item">
                                            <i class="fa fa-map-marker"></i> {{ $skill->user->location ?? 'Location not set' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fa fa-calendar"></i> Member since {{ $skill->user->created_at->format('M Y') }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fa fa-star"></i> {{ number_format($skill->user->getAverageRating(), 1) }} rating
                                        </span>
                                    </div>
                                    <div class="owner-stats">
                                        <div class="stat-item">
                                            <span class="stat-number">{{ $skill->user->getTotalExchangesCount() }}</span>
                                            <span class="stat-label">Exchanges</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-number">{{ $skill->user->skills()->count() }}</span>
                                            <span class="stat-label">Skills</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-number">{{ $skill->user->receivedReviews()->count() }}</span>
                                            <span class="stat-label">Reviews</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Details -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3><i class="fa fa-info-circle"></i> Skill Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="skill-details">
                                <div class="detail-item">
                                    <label>Category:</label>
                                    <span>{{ $skill->category }}</span>
                                </div>
                                <div class="detail-item">
                                    <label>Level:</label>
                                    <span class="level-badge level-{{ strtolower($skill->level) }}">{{ $skill->level }}</span>
                                </div>
                                @if($skill->experience_years)
                                <div class="detail-item">
                                    <label>Experience:</label>
                                    <span>{{ $skill->experience_years }} years</span>
                                </div>
                                @endif
                                @if($skill->hourly_rate)
                                <div class="detail-item">
                                    <label>Hourly Rate:</label>
                                    <span>${{ number_format($skill->hourly_rate, 2) }}/hour</span>
                                </div>
                                @endif
                                @if($skill->portfolio_url)
                                <div class="detail-item">
                                    <label>Portfolio:</label>
                                    <a href="{{ $skill->portfolio_url }}" target="_blank" class="portfolio-link">
                                        <i class="fa fa-external-link"></i> View Portfolio
                                    </a>
                                </div>
                                @endif
                                @if($skill->certifications)
                                <div class="detail-item">
                                    <label>Certifications:</label>
                                    <div class="certifications">
                                        @foreach(json_decode($skill->certifications) as $cert)
                                            <span class="certification-badge">{{ $cert }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3><i class="fa fa-star"></i> Reviews ({{ $skill->reviews->count() }})</h3>
                        </div>
                        <div class="card-body">
                            @if($skill->reviews->count() > 0)
                                <div class="reviews-summary">
                                    <div class="average-rating">
                                        <div class="rating-number">{{ number_format($skill->getAverageRating(), 1) }}</div>
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star {{ $i <= $skill->getAverageRating() ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="rating-text">out of 5</div>
                                    </div>
                                </div>
                                
                                <div class="reviews-list">
                                    @foreach($skill->reviews as $review)
                                        <div class="review-item">
                                            <div class="review-header">
                                                <div class="reviewer-info">
                                                    <img src="{{ $review->reviewer->avatar ? asset('storage/' . $review->reviewer->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                                         alt="{{ $review->reviewer->name }}" class="reviewer-avatar">
                                                    <div>
                                                        <h5>{{ $review->reviewer->name }}</h5>
                                                        <div class="review-rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                        </div>
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
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-reviews">
                                    <i class="fa fa-star"></i>
                                    <h4>No Reviews Yet</h4>
                                    <p>This skill hasn't received any reviews yet. Be the first to exchange and leave a review!</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Other Skills by This User -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3><i class="fa fa-cogs"></i> Other Skills by {{ $skill->user->name }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="other-skills">
                                @forelse($skill->user->skills->where('id', '!=', $skill->id) as $otherSkill)
                                    <div class="other-skill-item">
                                        <div class="skill-info">
                                            <h5>{{ $otherSkill->name }}</h5>
                                            <p>{{ Str::limit($otherSkill->description, 80) }}</p>
                                            <div class="skill-meta">
                                                <span class="category-badge">{{ $otherSkill->category }}</span>
                                                <span class="level-badge level-{{ strtolower($otherSkill->level) }}">{{ $otherSkill->level }}</span>
                                            </div>
                                        </div>
                                        <div class="skill-actions">
                                            <a href="{{ route('user.exchanges.skill-details', $otherSkill->id) }}" class="btn btn-outline-primary btn-sm">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-other-skills">
                                        <p>No other skills available from this user.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Exchange Card -->
                    <div class="sidebar-card">
                        <div class="card-header">
                            <h4><i class="fa fa-exchange"></i> Start Exchange</h4>
                        </div>
                        <div class="card-body">
                            @if($existingExchange)
                                <div class="existing-exchange">
                                    <i class="fa fa-info-circle text-info"></i>
                                    <p>You already have an active exchange with this user.</p>
                                    <a href="{{ route('user.exchanges.show', $existingExchange->id) }}" class="btn btn-primary">
                                        View Exchange
                                    </a>
                                </div>
                            @else
                                <div class="exchange-info">
                                    <p>Ready to exchange skills? Choose one of your skills to offer in return.</p>
                                    
                                    @if($userSkills->count() > 0)
                                        <div class="your-skills">
                                            <h5>Your Skills:</h5>
                                            <div class="skills-list">
                                                @foreach($userSkills as $userSkill)
                                                    <div class="skill-option">
                                                        <input type="radio" name="selected_skill" id="skill_{{ $userSkill->id }}" value="{{ $userSkill->id }}">
                                                        <label for="skill_{{ $userSkill->id }}">
                                                            <span class="skill-name">{{ $userSkill->name }}</span>
                                                            <span class="skill-level level-{{ strtolower($userSkill->level) }}">{{ $userSkill->level }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            <button class="btn btn-primary btn-block" onclick="showExchangeModal()">
                                                <i class="fa fa-exchange"></i> Start Exchange
                                            </button>
                                        </div>
                                    @else
                                        <div class="no-skills">
                                            <i class="fa fa-exclamation-triangle text-warning"></i>
                                            <p>You need to add skills to your profile before you can start exchanges.</p>
                                            <a href="{{ route('user.skills') }}" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Add Skills
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="sidebar-card">
                        <div class="card-header">
                            <h4><i class="fa fa-envelope"></i> Contact {{ $skill->user->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="contact-info">
                                @if($skill->user->email)
                                <div class="contact-item">
                                    <i class="fa fa-envelope"></i>
                                    <span>{{ $skill->user->email }}</span>
                                </div>
                                @endif
                                @if($skill->user->phone)
                                <div class="contact-item">
                                    <i class="fa fa-phone"></i>
                                    <span>{{ $skill->user->phone }}</span>
                                </div>
                                @endif
                                @if($skill->user->website)
                                <div class="contact-item">
                                    <i class="fa fa-globe"></i>
                                    <a href="{{ $skill->user->website }}" target="_blank">Website</a>
                                </div>
                                @endif
                            </div>
                            
                            <div class="social-links">
                                @if($skill->user->linkedin)
                                <a href="{{ $skill->user->linkedin }}" target="_blank" class="social-link linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                @endif
                                @if($skill->user->github)
                                <a href="{{ $skill->user->github }}" target="_blank" class="social-link github">
                                    <i class="fa fa-github"></i>
                                </a>
                                @endif
                                @if($skill->user->twitter)
                                <a href="{{ $skill->user->twitter }}" target="_blank" class="social-link twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Similar Skills -->
                    <div class="sidebar-card">
                        <div class="card-header">
                            <h4><i class="fa fa-lightbulb"></i> Similar Skills</h4>
                        </div>
                        <div class="card-body">
                            <div class="similar-skills">
                                @php
                                    $similarSkills = \App\Models\Skill::where('category', $skill->category)
                                        ->where('id', '!=', $skill->id)
                                        ->where('user_id', '!=', auth()->id())
                                        ->where('is_verified', true)
                                        ->limit(3)
                                        ->get();
                                @endphp
                                
                                @forelse($similarSkills as $similarSkill)
                                    <div class="similar-skill-item">
                                        <div class="skill-info">
                                            <h6>{{ $similarSkill->name }}</h6>
                                            <p>{{ Str::limit($similarSkill->description, 60) }}</p>
                                            <div class="skill-meta">
                                                <span class="user-name">{{ $similarSkill->user->name }}</span>
                                                <span class="level-badge level-{{ strtolower($similarSkill->level) }}">{{ $similarSkill->level }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('user.exchanges.skill-details', $similarSkill->id) }}" class="btn btn-outline-primary btn-sm">
                                            View
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-muted">No similar skills found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Exchange Modal -->
<div class="modal fade" id="exchangeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-exchange"></i> Start Exchange
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.exchanges.store') }}" method="POST" id="exchangeForm">
                    @csrf
                    <input type="hidden" name="participant_skill_id" value="{{ $skill->id }}">
                    
                    <div class="exchange-preview">
                        <div class="exchange-users">
                            <div class="user-card">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                     alt="{{ auth()->user()->name }}" class="user-avatar">
                                <h6>{{ auth()->user()->name }}</h6>
                                <p>You</p>
                            </div>
                            <div class="exchange-arrow">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <div class="user-card">
                                <img src="{{ $skill->user->avatar ? asset('storage/' . $skill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                     alt="{{ $skill->user->name }}" class="user-avatar">
                                <h6>{{ $skill->user->name }}</h6>
                                <p>{{ $skill->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="initiator_skill_id" class="form-label">
                            <i class="fa fa-cogs"></i> Your Skill to Offer <span class="required">*</span>
                        </label>
                        <select class="form-control" id="initiator_skill_id" name="initiator_skill_id" required>
                            <option value="">Select your skill</option>
                            @foreach($userSkills as $userSkill)
                                <option value="{{ $userSkill->id }}">{{ $userSkill->name }} ({{ $userSkill->level }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title" class="form-label">
                            <i class="fa fa-pencil"></i> Exchange Title <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="title" name="title" 
                               placeholder="e.g., Logo Design for Website Development" required>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">
                            <i class="fa fa-align-left"></i> Exchange Description <span class="required">*</span>
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="4" 
                                  placeholder="Describe what you want to achieve with this exchange..." required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estimated_hours" class="form-label">
                                    <i class="fa fa-clock-o"></i> Estimated Hours
                                </label>
                                <input type="number" class="form-control" id="estimated_hours" name="estimated_hours" 
                                       min="1" max="200" placeholder="e.g., 20">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="communication_preference" class="form-label">
                                    <i class="fa fa-comments"></i> Communication
                                </label>
                                <select class="form-control" id="communication_preference" name="communication_preference">
                                    <option value="">Select communication method</option>
                                    <option value="chat" selected>Chat</option>
                                    <option value="video">Video Call</option>
                                    <option value="email">Email</option>
                                    <option value="phone">Phone</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-list"></i> Terms & Conditions
                        </label>
                        <div class="terms-checkboxes">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="term_quality" name="terms[]" value="quality">
                                <label class="form-check-label" for="term_quality">
                                    Both parties agree to deliver high-quality work
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="term_communication" name="terms[]" value="communication">
                                <label class="form-check-label" for="term_communication">
                                    Maintain regular communication throughout the exchange
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="term_timeline" name="terms[]" value="timeline">
                                <label class="form-check-label" for="term_timeline">
                                    Respect agreed timelines and deadlines
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="exchangeForm" class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i> Send Exchange Proposal
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Skill Details Container */
.skill-details-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 0;
}

/* Header Section */
.skill-header-section {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 40px;
    margin-bottom: 30px;
}

.header-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80') center/cover;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
}

.skill-header-content {
    position: relative;
    z-index: 2;
}

.skill-info {
    color: #fff;
}

.skill-badges {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-featured {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

.badge-level {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

.skill-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 15px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    line-height: 1.2;
    word-wrap: break-word;
}

.skill-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 20px;
    line-height: 1.6;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.skill-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 25px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    opacity: 0.9;
    font-size: 0.9rem;
}

.meta-item i {
    width: 16px;
}

.skill-actions {
    text-align: center;
}

.skill-actions .btn {
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: 600;
    margin-bottom: 10px;
    width: 100%;
}

.existing-exchange-alert {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    color: #fff;
}

.existing-exchange-alert i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
}

/* Main Content */
.skill-main-content {
    background: #f8f9fa;
    min-height: 60vh;
    padding: 30px 0;
}

.content-card, .sidebar-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    overflow: visible;
    border: 1px solid #e9ecef;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 20px;
    border: none;
}

.card-header h3, .card-header h4 {
    margin: 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-body {
    padding: 30px;
}

/* Skill Owner */
.skill-owner {
    display: flex;
    gap: 20px;
    align-items: flex-start;
}

.owner-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.owner-info h4 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 15px;
    line-height: 1.3;
    word-wrap: break-word;
}

.owner-bio {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.owner-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
}

.owner-stats {
    display: flex;
    gap: 20px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
}

.stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Skill Details */
.skill-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f8f9fa;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item label {
    font-weight: 600;
    color: #333;
    min-width: 120px;
}

.level-badge {
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.portfolio-link {
    color: #667eea;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
}

.portfolio-link:hover {
    color: #764ba2;
    text-decoration: none;
}

.certifications {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.certification-badge {
    background: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 10px;
    font-size: 0.8rem;
}

/* Reviews */
.reviews-summary {
    text-align: center;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.average-rating {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.rating-number {
    font-size: 3rem;
    font-weight: 700;
    color: #667eea;
}

.rating-stars {
    display: flex;
    gap: 2px;
}

.rating-stars i {
    font-size: 1.2rem;
}

.rating-text {
    color: #6c757d;
    font-size: 0.9rem;
}

.reviews-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.review-item {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

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

.reviewer-info h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px;
}

.review-rating {
    display: flex;
    gap: 2px;
}

.review-rating i {
    font-size: 0.8rem;
}

.review-date {
    font-size: 0.8rem;
    color: #6c757d;
}

.review-content h6 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 8px;
}

.review-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

.empty-reviews {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.empty-reviews i {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 15px;
}

.empty-reviews h4 {
    color: #333;
    margin-bottom: 10px;
}

/* Other Skills */
.other-skills {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.other-skill-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.skill-info h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px;
}

.skill-info p {
    color: #666;
    font-size: 0.9rem;
    margin: 0 0 8px;
}

.skill-meta {
    display: flex;
    gap: 8px;
}

.category-badge {
    background: #e9ecef;
    color: #495057;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.7rem;
}

.empty-other-skills {
    text-align: center;
    color: #6c757d;
    padding: 20px;
}

/* Sidebar Cards */
.sidebar-card {
    margin-bottom: 25px;
}

.exchange-info p {
    color: #666;
    margin-bottom: 20px;
}

.your-skills h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.skills-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
}

.skill-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.skill-option input[type="radio"] {
    margin: 0;
}

.skill-option label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin: 0;
    cursor: pointer;
}

.skill-name {
    font-weight: 500;
    color: #333;
}

.no-skills {
    text-align: center;
    padding: 20px;
}

.no-skills i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
}

.no-skills p {
    color: #666;
    margin-bottom: 15px;
}

/* Contact Info */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
}

.contact-item i {
    width: 16px;
    color: #667eea;
}

.contact-item a {
    color: #667eea;
    text-decoration: none;
}

.contact-item a:hover {
    color: #764ba2;
}

.social-links {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link.linkedin { background: #0077b5; }
.social-link.github { background: #333; }
.social-link.twitter { background: #1da1f2; }

.social-link:hover {
    transform: translateY(-2px);
    color: #fff;
    text-decoration: none;
}

/* Similar Skills */
.similar-skills {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.similar-skill-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.similar-skill-item h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 3px;
}

.similar-skill-item p {
    color: #666;
    font-size: 0.8rem;
    margin: 0 0 5px;
}

.skill-meta {
    display: flex;
    gap: 5px;
    align-items: center;
}

.user-name {
    font-size: 0.7rem;
    color: #6c757d;
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    margin: 20px;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 15px 15px 0 0;
    border: none;
}

.modal-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.exchange-preview {
    text-align: center;
    margin-bottom: 30px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 10px;
}

.exchange-users {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
}

.user-card {
    text-align: center;
}

.user-card .user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.user-card h6 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px;
}

.user-card p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

.exchange-arrow {
    font-size: 1.5rem;
    color: #667eea;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-group {
    margin-bottom: 25px;
}

.form-label i {
    color: #667eea;
    width: 16px;
}

.required {
    color: #dc3545;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control option {
    padding: 10px;
    font-size: 1rem;
}

.form-control option:first-child {
    color: #6c757d;
    font-style: italic;
}

.form-control option:not(:first-child) {
    color: #333;
    font-weight: 500;
}

.form-control option[selected] {
    background-color: #667eea;
    color: #fff;
}

.terms-checkboxes {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 15px;
}

.form-check {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.form-check-input {
    margin-top: 3px;
}

.form-check-label {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.5;
    word-wrap: break-word;
}

/* Responsive Design */
@media (max-width: 768px) {
    .skill-title {
        font-size: 2rem;
    }
    
    .skill-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .skill-owner {
        flex-direction: column;
        text-align: center;
    }
    
    .owner-stats {
        justify-content: center;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .detail-item label {
        min-width: auto;
    }
    
    .exchange-users {
        flex-direction: column;
        gap: 15px;
    }
    
    .exchange-arrow {
        transform: rotate(90deg);
    }
    
    .card-body {
        padding: 20px;
    }
    
    .modal-content {
        margin: 10px;
    }
    
    .form-control {
        padding: 12px 15px;
    }
}

@media (max-width: 576px) {
    .skill-header-section {
        padding: 40px 0 30px;
    }
    
    .skill-main-content {
        padding: 20px 0;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .skill-title {
        font-size: 1.8rem;
    }
}
</style>

<script>
function showExchangeModal() {
    $('#exchangeModal').modal('show');
    
    // Set default communication preference if not already selected
    const communicationSelect = document.getElementById('communication_preference');
    if (communicationSelect && !communicationSelect.value) {
        // Set a sensible default option
        communicationSelect.value = 'chat';
    }
}

function showContactModal() {
    // Implement contact modal functionality
    alert('Contact functionality will be implemented here.');
}

// Form validation
document.getElementById('exchangeForm').addEventListener('submit', function(e) {
    const selectedSkill = document.querySelector('input[name="selected_skill"]:checked');
    if (!selectedSkill) {
        e.preventDefault();
        alert('Please select a skill to offer in exchange.');
        return;
    }
    
    // Set the selected skill value
    document.getElementById('initiator_skill_id').value = selectedSkill.value;
});
</script>
@endsection 