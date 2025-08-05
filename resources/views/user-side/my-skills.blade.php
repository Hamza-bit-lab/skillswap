@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Skills')

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

<!-- My Skills Container -->
<div class="my-skills-container">
    <!-- Header Section -->
    <div class="my-skills-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="my-skills-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-content">
                            <h1 class="header-title">My Skills</h1>
                            <p class="header-subtitle">Manage and showcase your professional skills to the community</p>
                            <div class="header-stats">
                                <div class="stat-item">
                                    <span class="stat-number">{{ auth()->user()->skills->count() }}</span>
                                    <span class="stat-label">Total Skills</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ auth()->user()->skills->where('is_verified', true)->count() }}</span>
                                    <span class="stat-label">Verified</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ auth()->user()->skills->where('is_featured', true)->count() }}</span>
                                    <span class="stat-label">Featured</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-actions">
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addSkillModal">
                                <i class="fa fa-plus"></i> Add New Skill
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Grid -->
    <div class="skills-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="skills-header">
                        <h3>Your Skills Portfolio</h3>
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
                @foreach(auth()->user()->skills as $skill)
                <!-- Skill Card -->
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="skill-card">
                        <div class="skill-header">
                            <div class="skill-icon">
                                @switch($skill->category)
                                    @case('Development')
                                        <i class="fa fa-code"></i>
                                        @break
                                    @case('Design')
                                        <i class="fa fa-paint-brush"></i>
                                        @break
                                    @case('Marketing')
                                        <i class="fa fa-bullhorn"></i>
                                        @break
                                    @case('Writing')
                                        <i class="fa fa-pencil"></i>
                                        @break
                                    @case('Photography')
                                        <i class="fa fa-camera"></i>
                                        @break
                                    @default
                                        <i class="fa fa-star"></i>
                                @endswitch
                            </div>
                            <div class="skill-status">
                                @if($skill->is_verified)
                                    <span class="status-badge verified">
                                        <i class="fa fa-check-circle"></i> Verified
                                    </span>
                                @else
                                    <span class="status-badge pending">
                                        <i class="fa fa-clock-o"></i> Pending
                                    </span>
                                @endif
                                @if($skill->is_featured)
                                    <span class="status-badge featured">
                                        <i class="fa fa-star"></i> Featured
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="skill-content">
                            <h4>{{ $skill->name }}</h4>
                            <p>{{ $skill->description }}</p>
                            <div class="skill-details">
                                <div class="detail-item">
                                    <i class="fa fa-tag"></i>
                                    <span>{{ $skill->category }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-level-up"></i>
                                    <span>{{ ucfirst($skill->level) }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{ $skill->experience_years }} years</span>
                                </div>
                                @if($skill->hourly_rate)
                                <div class="detail-item">
                                    <i class="fa fa-dollar"></i>
                                    <span>${{ $skill->hourly_rate }}/hr</span>
                                </div>
                                @endif
                            </div>
                            <div class="skill-tags">
                                <span class="tag">{{ $skill->category }}</span>
                                <span class="tag">{{ ucfirst($skill->level) }}</span>
                            </div>
                        </div>
                        <div class="skill-actions">
                            <button class="btn btn-primary btn-sm" onclick="editSkill({{ $skill->id }})">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline-primary btn-sm" onclick="viewSkill({{ $skill->id }})">
                                <i class="fa fa-eye"></i> View
                            </button>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteSkill({{ $skill->id }})">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Empty State -->
                @if(auth()->user()->skills->count() == 0)
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <h4>No Skills Added Yet</h4>
                        <p>Start building your skills portfolio to connect with other professionals</p>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addSkillModal">
                            <i class="fa fa-plus"></i> Add Your First Skill
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1" role="dialog" aria-labelledby="addSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSkillModalLabel">
                    <i class="fa fa-plus"></i> Add New Skill
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.skills.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skill_name" class="form-label">
                                    <i class="fa fa-star"></i> Skill Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="skill_name" name="name" required placeholder="e.g., Web Development, Graphic Design">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skill_category" class="form-label">
                                    <i class="fa fa-tags"></i> Category <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="skill_category" name="category" required>
                                    <option value="">Select category</option>
                                    <option value="Development">Development</option>
                                    <option value="Design">Design</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Writing">Writing</option>
                                    <option value="Photography">Photography</option>
                                    <option value="Video">Video</option>
                                    <option value="Business">Business</option>
                                    <option value="Consulting">Consulting</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skill_level" class="form-label">
                                    <i class="fa fa-level-up"></i> Skill Level <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="skill_level" name="level" required>
                                    <option value="">Select level</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                    <option value="expert">Expert</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="experience_years" class="form-label">
                                    <i class="fa fa-clock-o"></i> Experience Years
                                </label>
                                <input type="number" class="form-control" id="experience_years" name="experience_years" min="0" max="50" placeholder="Years of experience">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skill_description" class="form-label">
                            <i class="fa fa-align-left"></i> Description <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="skill_description" name="description" rows="3" required placeholder="Describe your skill, what you can offer, and your expertise level..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="hourly_rate" class="form-label">
                            <i class="fa fa-dollar"></i> Hourly Rate (Optional)
                        </label>
                        <input type="number" class="form-control" id="hourly_rate" name="hourly_rate" min="0" step="0.01" placeholder="Your preferred hourly rate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Skill
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.my-skills-container {
    min-height: 100vh;
    background: #f8f9fa;
}

.my-skills-header-section {
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

.my-skills-header-content {
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

.skills-section {
    padding: 0 1rem;
}

.skills-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.skills-header h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.view-options {
    display: flex;
    gap: 0.5rem;
}

.skill-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.skill-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.skill-header {
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

.skill-status {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.status-badge.verified {
    background: #d4edda;
    color: #155724;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.status-badge.featured {
    background: #f8d7da;
    color: #721c24;
}

.skill-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.skill-content p {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.skill-details {
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

.skill-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.tag {
    background: #e9ecef;
    color: #495057;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.skill-actions {
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

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.empty-icon {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

.empty-state h4 {
    color: #6c757d;
    margin-bottom: 1rem;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 2rem;
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.modal-header {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border-bottom: none;
}

.modal-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
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
    
    .skills-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .skill-actions {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const viewButtons = document.querySelectorAll('.view-options button');
    const skillsGrid = document.getElementById('skills-grid');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            if (view === 'list') {
                skillsGrid.classList.add('list-view');
            } else {
                skillsGrid.classList.remove('list-view');
            }
        });
    });
});

function editSkill(skillId) {
    // Add your edit skill logic here
    console.log('Editing skill:', skillId);
}

function viewSkill(skillId) {
    // Add your view skill logic here
    console.log('Viewing skill:', skillId);
}

function deleteSkill(skillId) {
    if (confirm('Are you sure you want to delete this skill?')) {
        // Add your delete skill logic here
        console.log('Deleting skill:', skillId);
    }
}
</script>

@endsection 