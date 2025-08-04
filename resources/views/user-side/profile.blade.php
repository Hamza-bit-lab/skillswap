@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Profile')

@section('content')
<div class="container-fluid profile-container">
    <!-- Profile Header -->
    <div class="profile-header mb-4">
        <div class="row">
            <div class="col-12">
                <div class="profile-info">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="mb-0">{{ $user->name }}</h2>
                            <p class="text-muted">{{ '@' . $user->username }}</p>
                        </div>
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                            <i class="fa fa-pencil"></i> Edit Profile
                        </a>
                    </div>
                    <div class="profile-stats mt-3">
                        <div class="row">
                            <div class="col-4">
                                <div class="stat-box">
                                    <h4>4.8</h4>
                                    <p>Rating</p>
                                    <div class="rating-stars">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star-half-o text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-box">
                                    <h4>127</h4>
                                    <p>Exchanges</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-box">
                                    <h4>15</h4>
                                    <p>Skills</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Profile Content -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-4">
            <!-- About Me Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">About Me</h5>
                    <button class="btn btn-sm btn-link">
                        <i class="fa fa-pencil"></i>
                    </button>
                </div>
                <div class="card-body">
                    <p>{{ Auth::user()->bio ?? 'No bio added yet.' }}</p>
                    <hr>
                    <div class="profile-details">
                        <div class="detail-item">
                            <i class="fa fa-map-marker"></i>
                            <span>{{ Auth::user()->location ?? 'Location not set' }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fa fa-calendar"></i>
                            <span>Joined {{ Auth::user()->created_at->format('F Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fa fa-language"></i>
                            <span>English, Spanish</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Skills</h5>
                    <button class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Add Skill
                    </button>
                </div>
                <div class="card-body">
                    <div class="skills-container">
                        @forelse($skills as $skill)
                            <div class="skill-item" id="skill-{{ $skill->id }}">
                                <span class="skill-name">{{ $skill->name }}</span>
                                <div class="d-flex align-items-center">
                                    <div class="skill-level mr-2">{{ $skill->level }}</div>
                                    <div class="skill-actions">
                                        <button class="btn btn-sm btn-link edit-skill" data-skill-id="{{ $skill->id }}">
                                            <i class="fa fa-pencil text-primary"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link delete-skill" data-skill-id="{{ $skill->id }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No skills added yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-md-8">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="exchanges-tab" data-toggle="tab" href="#exchanges" role="tab">
                        <i class="fa fa-exchange"></i> Exchanges
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab">
                        <i class="fa fa-star"></i> Reviews
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab">
                        <i class="fa fa-folder"></i> Portfolio
                    </a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Exchanges Tab -->
                <div class="tab-pane fade show active" id="exchanges" role="tabpanel">
                    <div class="exchanges-list">
                        @forelse($exchanges as $exchange)
                            <div class="exchange-item card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="card-title">{{ $exchange->skill->name }}</h5>
                                            <p class="card-text">Exchange with @{{ $exchange->partner->username }}</p>
                                            <span class="badge badge-{{ $exchange->status_color }}">{{ $exchange->status }}</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="exchange-date">{{ $exchange->created_at->format('M d, Y') }}</div>
                                            @if($exchange->rating)
                                                <div class="exchange-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star {{ $i <= $exchange->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted">No exchanges yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="reviews-list">
                        <!-- Review Item -->
                        <div class="review-item card mb-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="https://randomuser.me/api/portraits/women/45.jpg" 
                                         alt="Reviewer" 
                                         class="reviewer-image rounded-circle">
                                    <div class="review-content ml-3">
                                        <h5 class="reviewer-name">Sarah Johnson</h5>
                                        <div class="review-rating">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <p class="review-text">
                                            "Excellent web development skills! Delivered exactly what was promised and more."
                                        </p>
                                        <small class="text-muted">July 20, 2025</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more review items here -->
                    </div>
                </div>

                <!-- Portfolio Tab -->
                <div class="tab-pane fade" id="portfolio" role="tabpanel">
                    <div class="portfolio-grid">
                        <div class="row">
                            <!-- Portfolio Item -->
                            <div class="col-md-4 mb-4">
                                <div class="portfolio-item card">
                                    <img src="https://via.placeholder.com/300x200" 
                                         class="card-img-top" 
                                         alt="Portfolio Item">
                                    <div class="card-body">
                                        <h5 class="card-title">Project Name</h5>
                                        <p class="card-text">Brief project description</p>
                                        <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more portfolio items here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-container {
    padding: 30px;
}

.profile-image-container {
    position: relative;
    display: inline-block;
}

.profile-image {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.edit-overlay {
    position: absolute;
    bottom: 10px;
    right: 10px;
}

.profile-info {
    padding: 20px;
}

.stat-box {
    text-align: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 10px;
}

.stat-box h4 {
    margin: 0;
    color: #333;
    font-weight: 600;
}

.detail-item {
    margin-bottom: 10px;
}

.detail-item i {
    width: 20px;
    color: #666;
}

.skill-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.skill-level {
    font-size: 0.9em;
    color: #666;
}

.reviewer-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
}

.portfolio-item {
    transition: transform 0.3s;
}

.portfolio-item:hover {
    transform: translateY(-5px);
}
</style>
@endsection 