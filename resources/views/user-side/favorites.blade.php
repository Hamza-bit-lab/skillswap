@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Favorites')

@section('content')

@if(session('success'))
    <div class="container-fluid mt-3">
        <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
            <i class="fa fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<!-- Favorites Container -->
<div class="favorites-container">
    <!-- Header Section -->
    <div class="favorites-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="favorites-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-content">
                            <h1 class="header-title">My Favorites</h1>
                            <p class="header-subtitle">Quick access to your saved skills and professionals</p>
                            <div class="header-stats">
                                <div class="stat-item">
                                    <span class="stat-number">12</span>
                                    <span class="stat-label">Saved Skills</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">8</span>
                                    <span class="stat-label">Saved Users</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">5</span>
                                    <span class="stat-label">Recent Views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-actions">
                            <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-search"></i> Discover More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container-fluid">
            <div class="filter-card">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="type-filter" class="form-label">
                                <i class="fa fa-filter"></i> Type
                            </label>
                            <select class="form-control" id="type-filter">
                                <option value="all">All Favorites</option>
                                <option value="skills">Skills Only</option>
                                <option value="users">Users Only</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="category-filter" class="form-label">
                                <i class="fa fa-tags"></i> Category
                            </label>
                            <select class="form-control" id="category-filter">
                                <option value="all">All Categories</option>
                                <option value="Development">Development</option>
                                <option value="Design">Design</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Writing">Writing</option>
                                <option value="Photography">Photography</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="sort-filter" class="form-label">
                                <i class="fa fa-sort"></i> Sort By
                            </label>
                            <select class="form-control" id="sort-filter">
                                <option value="recent">Recently Added</option>
                                <option value="name">Name A-Z</option>
                                <option value="rating">Highest Rated</option>
                                <option value="popular">Most Popular</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-outline-primary btn-block" id="clear-filters">
                                <i class="fa fa-refresh"></i> Clear Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Favorites Content -->
    <div class="favorites-section">
        <div class="container-fluid">
            <!-- Tabs -->
            <div class="row">
                <div class="col-12">
                    <div class="favorites-tabs">
                        <button class="tab-button active" data-tab="skills">
                            <i class="fa fa-star"></i> Saved Skills
                        </button>
                        <button class="tab-button" data-tab="users">
                            <i class="fa fa-users"></i> Saved Users
                        </button>
                    </div>
                </div>
            </div>

            <!-- Skills Tab Content -->
            <div class="tab-content active" id="skills-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header">
                            <h3>Saved Skills</h3>
                            <div class="view-options">
                                <button class="btn btn-outline-secondary btn-sm active" data-view="grid">
                                    <i class="fa fa-th"></i> Grid
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" data-view="list">
                                    <i class="fa fa-list"></i> List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="skills-grid">
                    <!-- Skill Card 1 -->
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="favorite-skill-card">
                            <div class="skill-header">
                                <div class="skill-icon">
                                    <i class="fa fa-code"></i>
                                </div>
                                <div class="skill-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeFavorite('skill', 1)">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="skill-content">
                                <h4>Full Stack Web Development</h4>
                                <p>Comprehensive web development services including frontend, backend, and database design.</p>
                                <div class="skill-details">
                                    <div class="detail-item">
                                        <i class="fa fa-user"></i>
                                        <span>by Sarah Johnson</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-star"></i>
                                        <span>4.8 (24 reviews)</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-dollar"></i>
                                        <span>$45/hr</span>
                                    </div>
                                </div>
                                <div class="skill-tags">
                                    <span class="tag">Development</span>
                                    <span class="tag">Expert</span>
                                </div>
                            </div>
                            <div class="skill-footer">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-exchange"></i> Request Exchange
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Card 2 -->
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="favorite-skill-card">
                            <div class="skill-header">
                                <div class="skill-icon">
                                    <i class="fa fa-paint-brush"></i>
                                </div>
                                <div class="skill-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeFavorite('skill', 2)">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="skill-content">
                                <h4>UI/UX Design</h4>
                                <p>Professional user interface and user experience design for web and mobile applications.</p>
                                <div class="skill-details">
                                    <div class="detail-item">
                                        <i class="fa fa-user"></i>
                                        <span>by Mike Chen</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-star"></i>
                                        <span>4.9 (18 reviews)</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-dollar"></i>
                                        <span>$60/hr</span>
                                    </div>
                                </div>
                                <div class="skill-tags">
                                    <span class="tag">Design</span>
                                    <span class="tag">Advanced</span>
                                </div>
                            </div>
                            <div class="skill-footer">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-exchange"></i> Request Exchange
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Card 3 -->
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="favorite-skill-card">
                            <div class="skill-header">
                                <div class="skill-icon">
                                    <i class="fa fa-bullhorn"></i>
                                </div>
                                <div class="skill-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeFavorite('skill', 3)">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="skill-content">
                                <h4>Digital Marketing</h4>
                                <p>Comprehensive digital marketing strategies including SEO, social media, and content marketing.</p>
                                <div class="skill-details">
                                    <div class="detail-item">
                                        <i class="fa fa-user"></i>
                                        <span>by Emma Davis</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-star"></i>
                                        <span>4.7 (31 reviews)</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-dollar"></i>
                                        <span>$40/hr</span>
                                    </div>
                                </div>
                                <div class="skill-tags">
                                    <span class="tag">Marketing</span>
                                    <span class="tag">Expert</span>
                                </div>
                            </div>
                            <div class="skill-footer">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-exchange"></i> Request Exchange
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Tab Content -->
            <div class="tab-content" id="users-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header">
                            <h3>Saved Users</h3>
                            <div class="view-options">
                                <button class="btn btn-outline-secondary btn-sm active" data-view="grid">
                                    <i class="fa fa-th"></i> Grid
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" data-view="list">
                                    <i class="fa fa-list"></i> List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="users-grid">
                    <!-- User Card 1 -->
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="favorite-user-card">
                            <div class="user-header">
                                <div class="user-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User">
                                </div>
                                <div class="user-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeFavorite('user', 1)">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="user-content">
                                <h4>Sarah Johnson</h4>
                                <p class="user-title">Full Stack Developer</p>
                                <p class="user-bio">Passionate developer with 5+ years of experience in web technologies.</p>
                                <div class="user-details">
                                    <div class="detail-item">
                                        <i class="fa fa-star"></i>
                                        <span>4.8 (24 reviews)</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-exchange"></i>
                                        <span>15 exchanges</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-map-marker"></i>
                                        <span>San Francisco, CA</span>
                                    </div>
                                </div>
                                <div class="user-skills">
                                    <span class="skill-tag">Web Development</span>
                                    <span class="skill-tag">React</span>
                                    <span class="skill-tag">Node.js</span>
                                </div>
                            </div>
                            <div class="user-footer">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Profile
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-comment"></i> Message
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- User Card 2 -->
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="favorite-user-card">
                            <div class="user-header">
                                <div class="user-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                </div>
                                <div class="user-actions">
                                    <button class="btn btn-sm btn-outline-danger" onclick="removeFavorite('user', 2)">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="user-content">
                                <h4>Mike Chen</h4>
                                <p class="user-title">UI/UX Designer</p>
                                <p class="user-bio">Creative designer focused on creating intuitive and beautiful user experiences.</p>
                                <div class="user-details">
                                    <div class="detail-item">
                                        <i class="fa fa-star"></i>
                                        <span>4.9 (18 reviews)</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-exchange"></i>
                                        <span>12 exchanges</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fa fa-map-marker"></i>
                                        <span>New York, NY</span>
                                    </div>
                                </div>
                                <div class="user-skills">
                                    <span class="skill-tag">UI/UX Design</span>
                                    <span class="skill-tag">Figma</span>
                                    <span class="skill-tag">Prototyping</span>
                                </div>
                            </div>
                            <div class="user-footer">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Profile
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-comment"></i> Message
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.favorites-container {
    min-height: 100vh;
    background: #f8f9fa;
}

.favorites-header-section {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem 0;
    margin-bottom: 2rem;
}

.header-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: 1;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    z-index: 2;
}

.favorites-header-content {
    position: relative;
    z-index: 3;
}

.header-content {
    color: white;
}

.header-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.header-subtitle {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.header-stats {
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

.header-actions {
    text-align: right;
}

.filter-section {
    margin-bottom: 2rem;
}

.filter-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label i {
    color: #14a800;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control:focus {
    border-color: #14a800;
    box-shadow: 0 0 0 3px rgba(20, 168, 0, 0.1);
    background: white;
}

.favorites-section {
    padding: 0 1rem;
}

.favorites-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 1rem;
}

.tab-button {
    background: none;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    color: #6c757d;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tab-button:hover {
    background: #f8f9fa;
    color: #14a800;
}

.tab-button.active {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    color: white;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.section-header h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.view-options {
    display: flex;
    gap: 0.5rem;
}

.favorite-skill-card,
.favorite-user-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.favorite-skill-card:hover,
.favorite-user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.skill-header,
.user-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.skill-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.skill-actions,
.user-actions {
    display: flex;
    gap: 0.5rem;
}

.skill-content h4,
.user-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.user-title {
    color: #14a800;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.skill-content p,
.user-content p {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.user-bio {
    font-style: italic;
    font-size: 0.9rem;
}

.skill-details,
.user-details {
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #6c757d;
}

.detail-item i {
    color: #14a800;
    width: 16px;
}

.skill-tags,
.user-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.tag,
.skill-tag {
    background: #e9ecef;
    color: #495057;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.skill-footer,
.user-footer {
    display: flex;
    gap: 0.5rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(20, 168, 0, 0.3);
}

.btn-outline-primary {
    border: 2px solid #14a800;
    color: #14a800;
}

.btn-outline-primary:hover {
    background: #14a800;
    border-color: #14a800;
    color: white;
}

.btn-outline-danger {
    border: 2px solid #dc3545;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}

@media (max-width: 768px) {
    .header-title {
        font-size: 2rem;
    }
    
    .header-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .header-actions {
        text-align: center;
        margin-top: 1rem;
    }
    
    .favorites-tabs {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .skill-footer,
    .user-footer {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Remove active class from all tabs
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            document.getElementById(tabName + '-tab').classList.add('active');
        });
    });
    
    // Filter functionality
    const typeFilter = document.getElementById('type-filter');
    const categoryFilter = document.getElementById('category-filter');
    const sortFilter = document.getElementById('sort-filter');
    const clearFiltersBtn = document.getElementById('clear-filters');
    
    function applyFilters() {
        // Add your filter logic here
        console.log('Applying filters...');
    }
    
    typeFilter.addEventListener('change', applyFilters);
    categoryFilter.addEventListener('change', applyFilters);
    sortFilter.addEventListener('change', applyFilters);
    
    clearFiltersBtn.addEventListener('click', function() {
        typeFilter.value = 'all';
        categoryFilter.value = 'all';
        sortFilter.value = 'recent';
        applyFilters();
    });
    
    // View toggle functionality
    const viewButtons = document.querySelectorAll('.view-options button');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const parent = this.closest('.section-header');
            const viewButtons = parent.querySelectorAll('.view-options button');
            const gridId = this.closest('.tab-content').querySelector('[id$="-grid"]').id;
            
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            const grid = document.getElementById(gridId);
            
            if (view === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        });
    });
});

function removeFavorite(type, id) {
    if (confirm('Are you sure you want to remove this from favorites?')) {
        // Add your remove favorite logic here
        console.log('Removing favorite:', type, id);
    }
}
</script>

@endsection 