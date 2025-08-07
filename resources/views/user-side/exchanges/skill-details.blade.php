@extends('user-side.layouts.app')

@section('title', 'SkillSwap - ' . $skill->name . ' by ' . $skill->user->name)

@section('content')
<div class="skill-details-container">
    <!-- Header Section -->
    <div class="skill-details-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.exchanges.discover') }}">
                                    <i class="fa fa-arrow-left"></i> Back to Discover
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ $skill->name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-4 text-right">
                    <button class="btn btn-primary" onclick="showQuickExchange({{ $skill->id }})">
                        <i class="fa fa-exchange"></i> Quick Exchange
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Skill Details -->
            <div class="col-lg-8">
                <div class="skill-details-card">
                    <!-- Skill Header -->
                    <div class="skill-header">
                        <div class="skill-title-section">
                            <h1 class="skill-title">{{ $skill->name }}</h1>
                            <div class="skill-meta">
                                <span class="badge badge-level level-{{ strtolower($skill->level) }}">
                                    <i class="fa fa-level-up"></i> {{ ucfirst($skill->level) }}
                                </span>
                                <span class="badge badge-category">
                                    <i class="fa fa-tag"></i> {{ $skill->category }}
                                </span>
                                @if($skill->is_verified)
                                    <span class="badge badge-verified">
                                        <i class="fa fa-check-circle"></i> Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="skill-stats">
                            <div class="stat-item">
                                <div class="stat-number">{{ number_format($skill->getAverageRating(), 1) }}</div>
                                <div class="stat-label">Rating</div>
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= $skill->getAverageRating() ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">{{ $skill->getReviewsCount() }}</div>
                                <div class="stat-label">Reviews</div>
                            </div>
                            @if($skill->experience_years)
                            <div class="stat-item">
                                <div class="stat-number">{{ $skill->experience_years }}</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Skill Description -->
                    <div class="skill-description">
                        <h3>About This Skill</h3>
                        <p>{{ $skill->description }}</p>
                    </div>

                    <!-- Skill Details -->
                    <div class="skill-details-grid">
                        @if($skill->hourly_rate)
                        <div class="detail-item">
                            <i class="fa fa-dollar"></i>
                            <div class="detail-content">
                                <strong>Hourly Rate</strong>
                                <span>${{ number_format($skill->hourly_rate, 2) }}/hour</span>
                            </div>
                        </div>
                        @endif
                        
                        @if($skill->experience_years)
                        <div class="detail-item">
                            <i class="fa fa-clock-o"></i>
                            <div class="detail-content">
                                <strong>Experience</strong>
                                <span>{{ $skill->experience_years }} years</span>
                            </div>
                        </div>
                        @endif
                        
                        @if($skill->portfolio_url)
                        <div class="detail-item">
                            <i class="fa fa-link"></i>
                            <div class="detail-content">
                                <strong>Portfolio</strong>
                                <a href="{{ $skill->portfolio_url }}" target="_blank">View Portfolio</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($skill->certifications)
                        <div class="detail-item">
                            <i class="fa fa-certificate"></i>
                            <div class="detail-content">
                                <strong>Certifications</strong>
                                <span>{{ implode(', ', $skill->certifications) }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Reviews Section -->
                    @if($skill->reviews->count() > 0)
                    <div class="reviews-section">
                        <h3>Reviews ({{ $skill->reviews->count() }})</h3>
                        <div class="reviews-list">
                            @foreach($skill->reviews->take(5) as $review)
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="{{ $review->reviewer->avatar ? asset('storage/' . $review->reviewer->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="{{ $review->reviewer->name }}" class="reviewer-avatar">
                                        <div class="reviewer-details">
                                            <div class="reviewer-name">{{ $review->reviewer->name }}</div>
                                            <div class="review-date">{{ $review->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="review-content">
                                    <h5>{{ $review->title }}</h5>
                                    <p>{{ $review->comment }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- User Profile Sidebar -->
            <div class="col-lg-4">
                <div class="user-profile-card">
                    <div class="user-header">
                        <img src="{{ $skill->user->avatar ? asset('storage/' . $skill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                             alt="{{ $skill->user->name }}" class="user-avatar">
                        <div class="user-info">
                            <h3>{{ $skill->user->name }}</h3>
                            @if($skill->user->is_verified)
                                <span class="verification-badge">
                                    <i class="fa fa-check-circle"></i> Verified User
                                </span>
                            @endif
                            @if($skill->user->location)
                                <div class="user-location">
                                    <i class="fa fa-map-marker"></i> {{ $skill->user->location }}
                                </div>
                            @endif
                            <div class="user-rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= $skill->user->getAverageRating() ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-text">{{ number_format($skill->user->getAverageRating(), 1) }} ({{ $skill->user->receivedReviews->count() }} reviews)</span>
                            </div>
                        </div>
                    </div>

                    @if($skill->user->bio)
                    <div class="user-bio">
                        <h4>About</h4>
                        <p>{{ $skill->user->bio }}</p>
                    </div>
                    @endif

                    <div class="user-skills">
                        <h4>Skills Offered</h4>
                        <div class="skills-list">
                            @foreach($skill->user->skills->take(5) as $userSkill)
                            <div class="skill-item">
                                <span class="skill-name">{{ $userSkill->name }}</span>
                                <span class="skill-level level-{{ strtolower($userSkill->level) }}">{{ ucfirst($userSkill->level) }}</span>
                            </div>
                            @endforeach
                            @if($skill->user->skills->count() > 5)
                                <div class="more-skills">
                                    <a href="#" class="text-primary">+{{ $skill->user->skills->count() - 5 }} more skills</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="user-stats">
                        <div class="stat-item">
                            <div class="stat-number">{{ $skill->user->getTotalExchangesCount() }}</div>
                            <div class="stat-label">Total Exchanges</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $skill->user->getCompletedExchangesCount() }}</div>
                            <div class="stat-label">Completed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $skill->user->skills->count() }}</div>
                            <div class="stat-label">Skills</div>
                        </div>
                    </div>

                    @if($existingExchange)
                    <div class="existing-exchange-alert">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            <strong>Active Exchange:</strong> You already have an exchange with this user.
                            <a href="{{ route('user.exchanges.show', encrypt($existingExchange->id)) }}" class="btn btn-sm btn-primary mt-2">
                                View Exchange
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="exchange-actions">
                        <button class="btn btn-primary btn-block" onclick="showQuickExchange('{{ encrypt($skill->id) }}')">
                            <i class="fa fa-exchange"></i> Propose Exchange
                        </button>
                        <button class="btn btn-outline-primary btn-block">
                            <i class="fa fa-envelope"></i> Send Message
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Exchange Modal -->
<div class="modal fade" id="quickExchangeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-exchange"></i> Quick Exchange
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="quickExchangeContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
.skill-details-container {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 20px 0;
}

.skill-details-header {
    background: white;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
    margin-bottom: 30px;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #14a800;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.skill-details-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.skill-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.skill-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin: 0 0 15px 0;
}

.skill-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.badge {
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-level {
    background: #e9ecef;
    color: #495057;
}

.level-beginner { background: #d4edda; color: #155724; }
.level-intermediate { background: #fff3cd; color: #856404; }
.level-advanced { background: #cce5ff; color: #004085; }
.level-expert { background: #f8d7da; color: #721c24; }

.badge-category {
    background: #14a800;
    color: white;
}

.badge-verified {
    background: #28a745;
    color: white;
}

.skill-stats {
    display: flex;
    gap: 20px;
    text-align: center;
}

.stat-item {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    min-width: 80px;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.stars {
    display: flex;
    gap: 2px;
    justify-content: center;
}

.stars i {
    font-size: 0.8rem;
}

.skill-description {
    margin-bottom: 30px;
}

.skill-description h3 {
    color: #333;
    margin-bottom: 15px;
}

.skill-description p {
    color: #666;
    line-height: 1.6;
    font-size: 1.1rem;
}

.skill-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.detail-item i {
    font-size: 1.5rem;
    color: #14a800;
    width: 30px;
    text-align: center;
}

.detail-content {
    flex: 1;
}

.detail-content strong {
    display: block;
    color: #333;
    margin-bottom: 5px;
}

.detail-content span,
.detail-content a {
    color: #666;
    text-decoration: none;
}

.detail-content a:hover {
    color: #14a800;
}

.reviews-section {
    border-top: 2px solid #f8f9fa;
    padding-top: 30px;
}

.reviews-section h3 {
    color: #333;
    margin-bottom: 20px;
}

.review-item {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 15px;
    border: 1px solid #e9ecef;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.reviewer-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.reviewer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.reviewer-name {
    font-weight: 600;
    color: #333;
}

.review-date {
    font-size: 0.8rem;
    color: #6c757d;
}

.review-rating {
    display: flex;
    gap: 2px;
}

.review-content h5 {
    color: #333;
    margin-bottom: 10px;
}

.review-content p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

/* User Profile Sidebar */
.user-profile-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    position: sticky;
    top: 20px;
}

.user-header {
    text-align: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.user-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #14a800;
    margin-bottom: 15px;
}

.user-info h3 {
    color: #333;
    margin-bottom: 10px;
}

.verification-badge {
    color: #28a745;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.user-location {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.user-rating {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.rating-text {
    font-size: 0.9rem;
    color: #6c757d;
}

.user-bio {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.user-bio h4 {
    color: #333;
    margin-bottom: 10px;
}

.user-bio p {
    color: #666;
    line-height: 1.5;
    margin: 0;
}

.user-skills {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.user-skills h4 {
    color: #333;
    margin-bottom: 15px;
}

.skills-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.skill-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.skill-name {
    font-weight: 600;
    color: #333;
}

.skill-level {
    font-size: 0.7rem;
    padding: 2px 8px;
    border-radius: 10px;
    font-weight: 600;
}

.more-skills {
    text-align: center;
    padding: 10px;
}

.user-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.user-stats .stat-item {
    text-align: center;
    padding: 15px 10px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.user-stats .stat-number {
    font-size: 1.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.user-stats .stat-label {
    font-size: 0.7rem;
    color: #6c757d;
    margin: 0;
}

.existing-exchange-alert {
    margin-bottom: 20px;
}

.exchange-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.exchange-actions .btn {
    border-radius: 8px;
    padding: 12px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .skill-header {
        flex-direction: column;
        gap: 20px;
    }
    
    .skill-stats {
        justify-content: center;
    }
    
    .skill-details-grid {
        grid-template-columns: 1fr;
    }
    
    .user-profile-card {
        position: static;
        margin-top: 20px;
    }
}
</style>

<script>
// Quick Exchange Modal
function showQuickExchange(skillId) {
    // Load skill details and user's skills for exchange
    fetch(`/dashboard/exchanges/quick-exchange/${skillId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('quickExchangeContent').innerHTML = data.html;
                $('#quickExchangeModal').modal('show');
            } else {
                alert(data.message || 'Error loading exchange form. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error loading quick exchange:', error);
            alert('Error loading exchange form. Please try again.');
        });
}

// Submit quick exchange
function submitQuickExchange() {
    const form = document.getElementById('quickExchangeForm');
    const formData = new FormData(form);

    // Debug: Log form data
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('CSRF Token:', csrfToken);

    fetch('/dashboard/exchanges/quick-exchange', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            $('#quickExchangeModal').modal('hide');
            window.location.href = data.redirect;
        } else {
            alert(data.message || 'Error creating exchange. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error submitting exchange:', error);
        alert('Error creating exchange. Please try again.');
    });
}
</script>
@endsection 