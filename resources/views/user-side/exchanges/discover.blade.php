@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Discover Skills')

@section('content')
<div class="discover-container">
    <!-- Header Section -->
    <div class="discover-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="discover-header-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-content">
                            <h1 class="header-title">Discover Skills to Swap</h1>
                            <p class="header-subtitle">Find the perfect skill match and start exchanging services with other freelancers</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-stats">
                            <div class="stat-item">
                                <span class="stat-number">{{ $skills->total() }}</span>
                                <span class="stat-label">Available Skills</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ $categories->count() }}</span>
                                <span class="stat-label">Categories</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Search & Filter Section -->
    <div class="search-filter-section">
        <div class="container">
            <div class="search-filter-card">
                <form action="{{ route('user.exchanges.discover') }}" method="GET" id="searchForm">
                    <!-- Enhanced Search Fields -->
                    <div class="search-header">
                        <h4><i class="fa fa-exchange"></i> Find Your Perfect Skill Exchange</h4>
                        <p>Tell us what you're looking for and what you can offer</p>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="looking_for" class="form-label">
                                    <i class="fa fa-search"></i> What are you looking for? <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control search-input" 
                                       id="looking_for" 
                                       name="looking_for" 
                                       value="{{ request('looking_for') }}"
                                       placeholder="e.g., Web Development, Logo Design, Content Writing...">
                                <small class="form-text text-muted">Describe the skill or service you need</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="will_offer" class="form-label">
                                    <i class="fa fa-gift"></i> What will you offer in exchange?
                                </label>
                                <input type="text" 
                                       class="form-control search-input" 
                                       id="will_offer" 
                                       name="will_offer" 
                                       value="{{ request('will_offer') }}"
                                       placeholder="e.g., Graphic Design, Photography, Marketing...">
                                <small class="form-text text-muted">Describe what you can offer (optional)</small>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Filters -->
                    <div class="advanced-filters">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="category" class="form-label">
                                        <i class="fa fa-tags"></i> Category
                                    </label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="level" class="form-label">
                                        <i class="fa fa-star"></i> Level
                                    </label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="">All Levels</option>
                                        <option value="beginner" {{ request('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ request('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advanced" {{ request('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                        <option value="expert" {{ request('level') == 'expert' ? 'selected' : '' }}>Expert</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="location" class="form-label">
                                        <i class="fa fa-map-marker"></i> Location
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="location" 
                                           name="location" 
                                           value="{{ request('location') }}"
                                           placeholder="City, Country">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="min_rate" class="form-label">
                                        <i class="fa fa-dollar"></i> Min Rate
                                    </label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="min_rate" 
                                           name="min_rate" 
                                           value="{{ request('min_rate') }}"
                                           placeholder="0" min="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="max_rate" class="form-label">
                                        <i class="fa fa-dollar"></i> Max Rate
                                    </label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="max_rate" 
                                           name="max_rate" 
                                           value="{{ request('max_rate') }}"
                                           placeholder="1000" min="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="sort" class="form-label">
                                        <i class="fa fa-sort"></i> Sort By
                                    </label>
                                    <select class="form-control" id="sort" name="sort">
                                        <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search Actions -->
                    <div class="search-actions">
                        <div class="row">
                            <div class="col-lg-8">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fa fa-search"></i> Find Matching Skills
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-lg" id="clearFilters">
                                    <i class="fa fa-refresh"></i> Clear All Filters
                                </button>
                            </div>
                            <div class="col-lg-4 text-right">
                                <button type="button" class="btn btn-outline-info btn-sm" id="toggleAdvanced">
                                    <i class="fa fa-cog"></i> Advanced Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Skills Grid Section -->
    <div class="skills-grid-section">
        <div class="container">
            <!-- Results Header -->
            <div class="results-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="results-title">
                            <i class="fa fa-lightbulb"></i> 
                            Available Skills 
                            <span class="results-count">({{ $skills->total() }} found)</span>
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="view-options">
                            <button class="btn btn-sm btn-outline-primary active" data-view="grid">
                                <i class="fa fa-th"></i> Grid
                            </button>
                            <button class="btn btn-sm btn-outline-primary" data-view="list">
                                <i class="fa fa-list"></i> List
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Skills Grid -->
            <div class="skills-grid" id="skillsGrid">
    @forelse($skills as $skill) 
        <div class="skill-card enhanced" data-skill-id="{{ $skill->id }}">
            
            <!-- Card Header with User Info -->
            <div class="skill-header">
                <div class="skill-user">
                    <div class="user-avatar-container">
                        <img src="{{ $skill->user->avatar ? asset('storage/' . $skill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                             alt="{{ $skill->user->name }}" 
                             class="user-avatar">
                        @if($skill->user->is_verified)
                            <div class="verification-badge">
                                <i class="fa fa-check-circle"></i>
                            </div>
                        @endif
                    </div>
                    <div class="user-info">
                        <h5 class="user-name">
                            {{ $skill->user->name }}
                        </h5>
                        <span class="user-location">
                            <i class="fa fa-map-marker"></i> {{ $skill->user->location ?? 'Location not set' }}
                        </span>
                        <div class="user-rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $skill->user->getAverageRating() ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <span class="rating-text">{{ number_format($skill->user->getAverageRating(), 1) }}</span>
                        </div>
                        <div class="user-actions mt-2">
                            <a href="{{ route('user.profile.public', ['user' => $skill->user->username]) }}" class="btn btn-sm btn-outline-primary">View Profile</a>
                            <button class="btn btn-sm btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ url('/profile/' . $skill->user->username) }}'); alert('Profile link copied!')"><i class="fa fa-share"></i> Share</button>
                        </div>
                    </div>
                </div>

               
            </div>

            <!-- Skill Content -->
            <div class="skill-content">
                <div class="skill-title-section">
                    <h4 class="skill-title">
                        {{ $skill->name }}
                        <span class="badge badge-level level-{{ strtolower($skill->level) }}">
                    <i class="fa fa-level-up"></i> {{ ucfirst($skill->level) }}
                </span>
                    </h4>
                    <div class="skill-category">
                        <i class="fa fa-tag"></i> {{ $skill->category }}
                    </div>
                </div>

                <p class="skill-description">{{ Str::limit($skill->description, 150) }}</p>
                
                <!-- Skill Stats -->
                <div class="skill-stats">
                    <div class="stat-item">
                        <i class="fa fa-star"></i>
                        <span>{{ number_format($skill->getAverageRating(), 1) }}</span>
                        <small>{{ $skill->getReviewsCount() }} reviews</small>
                    </div>
                    <div class="stat-item">
                        <i class="fa fa-exchange"></i>
                        <small>exchanges</small>
                    </div>
                    @if($skill->experience_years)
                    <div class="stat-item">
                        <i class="fa fa-clock-o"></i>
                        <span>{{ $skill->experience_years }}</span>
                        <small>years</small>
                    </div>
                    @endif
                </div>

                <!-- Skills Offered by User -->
                <div class="user-skills">
                    <h6>Skills Offered:</h6>
                    <div class="skills-tags">
                        @foreach($skill->user->skills->take(3) as $userSkill)
                            <span class="skill-tag">{{ $userSkill->name }}</span>
                        @endforeach
                        @if($skill->user->skills->count() > 3)
                            <span class="skill-tag more">+{{ $skill->user->skills->count() - 3 }} more</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Actions -->
            <div class="skill-actions">
                <a href="{{ route('user.exchanges.skill-details', encrypt($skill->id)) }}" 
                   class="btn btn-primary btn-sm">
                    <i class="fa fa-eye"></i> View Details
                </a>
                <button class="btn btn-outline-primary btn-sm" 
                        onclick="showQuickExchange('{{ encrypt($skill->id) }}')">
                    <i class="fa fa-exchange"></i> Quick Exchange
                </button>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa fa-search"></i>
            </div>
            <h4>No Skills Found</h4>
            <p>Try adjusting your search criteria or browse all available skills.</p>
            <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary">
                <i class="fa fa-refresh"></i> Clear Filters
            </a>
        </div>
    @endforelse
</div>


            <!-- Pagination -->
            @if($skills->hasPages())
                <div class="pagination-wrapper">
                    {{ $skills->appends(request()->query())->links() }}
                </div>
            @endif
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
            <div class="modal-body">
                <div id="quickExchangeContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Discover Container */
.discover-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    padding: 0;
}

/* Header Section */
.discover-header-section {
    position: relative;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
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
    background: linear-gradient(135deg, rgba(75, 156, 211, 0.9) 0%, rgba(58, 123, 179, 0.9) 100%);
}

.discover-header-content {
    position: relative;
    z-index: 2;
}

.header-content {
    color: #fff;
}

.header-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.header-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 10px 0 0;
}

.header-stats {
    display: flex;
    gap: 30px;
    justify-content: flex-end;
}

.stat-item {
    text-align: center;
    color: #fff;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Search & Filter Section */
.search-filter-section {
    margin-bottom: 30px;
}

.search-filter-card {
    background: #fff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.search-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid #f8f9fa;
}

.search-header h4 {
    color: #333;
    font-weight: 700;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.search-header h4 i {
    color: #4B9CD3;
}

.search-header p {
    color: #6c757d;
    margin: 0;
    font-size: 1.1rem;
}

.search-input {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.search-input:focus {
    border-color: #4B9CD3;
    box-shadow: 0 0 0 4px rgba(75, 156, 211, 0.1);
    background: white;
    transform: translateY(-2px);
}

.advanced-filters {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    border: 1px solid #e9ecef;
}

.search-actions {
    padding-top: 1.5rem;
    border-top: 2px solid #f8f9fa;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label i {
    color: #4B9CD3;
    width: 16px;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #4B9CD3;
    box-shadow: 0 0 0 0.2rem rgba(75, 156, 211, 0.25);
}

.btn {
    border-radius: 10px;
    padding: 12px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(75, 156, 211, 0.3);
}

/* Skills Grid Section */
.skills-grid-section {
    background: #f8f9fa;
    min-height: 60vh;
    padding: 30px 0;
}

.results-header {
    margin-bottom: 30px;
}

.results-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.results-title i {
    color: #4B9CD3;
}

.results-count {
    font-size: 1rem;
    color: #6c757d;
    font-weight: 400;
}

.view-options {
    display: flex;
    gap: 10px;
}

.view-options .btn {
    padding: 8px 16px;
    font-size: 0.9rem;
}

/* Skills Grid */
.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.skill-card {
    background: #fff;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    min-height: 320px;
    display: flex;
    flex-direction: column;
}

.skill-card.enhanced {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border: 2px solid #e9ecef;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.skill-card.enhanced:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: #4B9CD3;
}

.skill-card.enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
}

.skill-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.skill-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
}

/* Skill Header */
.skill-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.skill-user {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-avatar-container {
    position: relative;
}

.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.verification-badge {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 20px;
    height: 20px;
    background: #4B9CD3;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 10px;
    border: 2px solid #fff;
}

.user-info h5 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #333;
    margin: 0 0 5px;
}

.user-name {
    color: #4B9CD3;
}

.user-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 5px;
}

.user-rating .stars {
    display: flex;
    gap: 2px;
}

.user-rating .stars i {
    font-size: 12px;
}

.user-rating .rating-text {
    font-size: 0.8rem;
    font-weight: 600;
    color: #4B9CD3;
}

.user-location {
    font-size: 0.8rem;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 5px;
}

.skill-badges {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
}

.badge-featured {
    background: #fff3cd;
    color: #856404;
}

.badge-level {
    text-align: center;
}

.level-beginner { background: #d4edda; color: #155724; }
.level-intermediate { background: #fff3cd; color: #856404; }
.level-advanced { background: #cce5ff; color: #004085; }
.level-expert { background: #f8d7da; color: #721c24; }

/* Skill Content */
.skill-content {
    margin-bottom: 20px;
}

.skill-title-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.skill-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #333;
    margin: 0;
    flex: 1;
    line-height: 1.3;
    word-wrap: break-word;
}

.skill-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 20px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    font-size: 0.95rem;
}

.skill-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.skill-stats .stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.skill-stats .stat-item i {
    color: #4B9CD3;
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.skill-stats .stat-item span {
    font-weight: 700;
    color: #333;
    font-size: 1.1rem;
}

.skill-stats .stat-item small {
    color: #6c757d;
    font-size: 0.8rem;
}

.skill-price {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: white;
    padding: 12px 15px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.price-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price-label {
    font-weight: 600;
    font-size: 0.9rem;
}

.price-value {
    font-weight: 700;
    font-size: 1.1rem;
}

.user-skills {
    margin-bottom: 20px;
}

.user-skills h6 {
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    font-size: 0.9rem;
}

.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.skill-tag {
    background: #e9ecef;
    color: #495057;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.skill-tag:hover {
    background: #4B9CD3;
    color: white;
}

.skill-tag.more {
    background: #4B9CD3;
    color: white;
    font-style: italic;
}

.skill-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
}

.skill-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}

.skill-rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stars {
    display: flex;
    gap: 2px;
}

.stars i {
    font-size: 0.8rem;
}

.rating-text {
    font-size: 0.8rem;
    color: #6c757d;
}

.category-badge {
    background: #e9ecef;
    color: #495057;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.skill-experience {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #6c757d;
}

/* Skill Actions */
.skill-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: auto;
    padding-top: 20px;
}

.skill-actions .btn {
    flex: 1;
    padding: 12px 18px;
    font-size: 0.9rem;
    min-width: 120px;
    white-space: nowrap;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #666;
    grid-column: 1 / -1;
}

.empty-icon {
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

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination {
    display: flex;
    gap: 5px;
}

.page-link {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    color: #4B9CD3;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #4B9CD3;
    border-color: #4B9CD3;
    color: #fff;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    border-color: transparent;
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
}

.modal-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
    border-radius: 15px 15px 0 0;
    border: none;
}

.modal-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-title {
        font-size: 2rem;
    }
    
    .header-stats {
        justify-content: flex-start;
        margin-top: 20px;
    }
    
    .skills-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .skill-card {
        padding: 25px;
        min-height: auto;
    }
    
    .skill-card.enhanced {
        padding: 20px;
    }
    
    .skill-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .skill-actions {
        flex-direction: column;
        gap: 10px;
    }
    
    .skill-actions .btn {
        width: 100%;
        min-width: auto;
    }
    
    .search-filter-card {
        padding: 20px;
    }
    
    .search-header h4 {
        font-size: 1.2rem;
    }
    
    .search-header p {
        font-size: 1rem;
    }
    
    .advanced-filters {
        padding: 1rem;
    }
    
    .skill-stats {
        flex-direction: column;
        gap: 15px;
    }
    
    .skill-stats .stat-item {
        flex-direction: row;
        justify-content: space-between;
        text-align: left;
    }
    
    .results-header {
        flex-direction: column;
        gap: 15px;
    }
    
    .view-options {
        justify-content: center;
    }
    
    .skill-meta {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .user-skills {
        margin-bottom: 15px;
    }
    
    .skills-tags {
        gap: 6px;
    }
    
    .skill-tag {
        font-size: 0.75rem;
        padding: 3px 10px;
    }
}

@media (max-width: 576px) {
    .discover-header-section {
        padding: 40px 0 30px;
    }
    
    .skills-grid-section {
        padding: 20px 0;
    }
    
    .skill-card {
        padding: 20px;
    }
    
    .header-title {
        font-size: 1.8rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchForm = document.getElementById('searchForm');
    const lookingForInput = document.getElementById('looking_for');
    const willOfferInput = document.getElementById('will_offer');
    
    // Auto-submit on input change (with debounce)
    let searchTimeout;
    function debouncedSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (lookingForInput.value.trim() || willOfferInput.value.trim()) {
                searchForm.submit();
            }
        }, 1000);
    }
    
    lookingForInput.addEventListener('input', debouncedSearch);
    willOfferInput.addEventListener('input', debouncedSearch);
    
    // Clear filters functionality
    document.getElementById('clearFilters').addEventListener('click', function() {
        window.location.href = '{{ route("user.exchanges.discover") }}';
    });

    // Toggle advanced filters
    const toggleAdvancedBtn = document.getElementById('toggleAdvanced');
    const advancedFilters = document.querySelector('.advanced-filters');
    
    if (toggleAdvancedBtn && advancedFilters) {
        toggleAdvancedBtn.addEventListener('click', function() {
            advancedFilters.style.display = advancedFilters.style.display === 'none' ? 'block' : 'none';
            this.innerHTML = advancedFilters.style.display === 'none' ? 
                '<i class="fa fa-cog"></i> Advanced Filters' : 
                '<i class="fa fa-times"></i> Hide Filters';
        });
    }

    // View toggle functionality
    const viewButtons = document.querySelectorAll('.view-options .btn');
    const skillsGrid = document.getElementById('skillsGrid');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active button
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Update grid layout
            if (view === 'list') {
                skillsGrid.style.gridTemplateColumns = '1fr';
            } else {
                skillsGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(350px, 1fr))';
            }
        });
    });

    // Auto-submit form on filter change
    const filterInputs = document.querySelectorAll('#searchForm select, #searchForm input[type="text"]');
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    });
});

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