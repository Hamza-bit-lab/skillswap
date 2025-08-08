@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Skills')

@section('content')

@if(session('success'))
    <div class="container mt-3">
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
    <div class="skills-header">
        <div class="container">
            <div class="header-content">
                <div class="header-info">
                    <h1 class="header-title">
                        <i class="fa fa-cogs"></i> My Skills
                    </h1>
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
                <div class="header-actions">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSkillModal">
                        <i class="fa fa-plus"></i> Add New Skill
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Grid -->
    <div class="skills-section">
        <div class="container-fluid">
            <div class="skills-header-row">
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

            <div class="skills-grid" id="skills-grid">
                @foreach(auth()->user()->skills as $skill)
                <!-- Skill Card -->
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
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteSkill({{ $skill->id }}, '{{ $skill->name }}')">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
                @endforeach

                <!-- Empty State -->
                @if(auth()->user()->skills->count() == 0)
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fa fa-star"></i>
                    </div>
                    <h4>No Skills Added Yet</h4>
                    <p>Start building your skills portfolio to connect with other professionals</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSkillModal">
                        <i class="fa fa-plus"></i> Add Your First Skill
                    </button>
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
            <form action="{{ route('user.skills.add') }}" method="POST" id="addSkillForm">
                @csrf
                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="skill_name" class="form-label">
                                <i class="fa fa-star"></i> Skill Name <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="skill_name" name="name" required placeholder="e.g., Web Development, Graphic Design">
                        </div>
                        <div class="form-group">
                            <label for="skill_category" class="form-label">
                                <i class="fa fa-tags"></i> Category <span class="required">*</span>
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
                        <div class="form-group">
                            <label for="skill_level" class="form-label">
                                <i class="fa fa-level-up"></i> Skill Level <span class="required">*</span>
                            </label>
                            <select class="form-control" id="skill_level" name="level" required>
                                <option value="">Select level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="experience_years" class="form-label">
                                <i class="fa fa-clock-o"></i> Experience Years
                            </label>
                            <input type="number" class="form-control" id="experience_years" name="experience_years" min="0" max="50" placeholder="Years of experience">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skill_description" class="form-label">
                            <i class="fa fa-align-left"></i> Description <span class="required">*</span>
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
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Skill
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Skill Modal -->
<div class="modal fade" id="editSkillModal" tabindex="-1" role="dialog" aria-labelledby="editSkillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSkillModalLabel">
                    <i class="fa fa-edit"></i> Edit Skill
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSkillForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="edit_skill_name" class="form-label">
                                <i class="fa fa-star"></i> Skill Name <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control" id="edit_skill_name" name="name" required placeholder="e.g., Web Development, Graphic Design">
                        </div>
                        <div class="form-group">
                            <label for="edit_skill_category" class="form-label">
                                <i class="fa fa-tags"></i> Category <span class="required">*</span>
                            </label>
                            <select class="form-control" id="edit_skill_category" name="category" required>
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
                        <div class="form-group">
                            <label for="edit_skill_level" class="form-label">
                                <i class="fa fa-level-up"></i> Skill Level <span class="required">*</span>
                            </label>
                            <select class="form-control" id="edit_skill_level" name="level" required>
                                <option value="">Select level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_experience_years" class="form-label">
                                <i class="fa fa-clock-o"></i> Experience Years
                            </label>
                            <input type="number" class="form-control" id="edit_experience_years" name="experience_years" min="0" max="50" placeholder="Years of experience">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_skill_description" class="form-label">
                            <i class="fa fa-align-left"></i> Description <span class="required">*</span>
                        </label>
                        <textarea class="form-control" id="edit_skill_description" name="description" rows="3" required placeholder="Describe your skill, what you can offer, and your expertise level..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_hourly_rate" class="form-label">
                            <i class="fa fa-dollar"></i> Hourly Rate (Optional)
                        </label>
                        <input type="number" class="form-control" id="edit_hourly_rate" name="hourly_rate" min="0" step="0.01" placeholder="Your preferred hourly rate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Skill
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* My Skills Container */
.my-skills-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Header Section */
.skills-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    padding: 40px 0;
    color: #fff;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-info {
    flex: 1;
}

.header-title {
    font-size: 2rem;
    font-weight: 600;
    margin: 0 0 10px 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.9);
    margin: 0 0 20px 0;
}

.header-stats {
    display: flex;
    gap: 30px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
}

.stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.8);
}

.header-actions {
    flex-shrink: 0;
}

/* Skills Section */
.skills-section {
    padding: 40px 0;
}

.skills-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.skills-header-row h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #212529;
    margin: 0;
}

.view-options {
    display: flex;
    gap: 10px;
}

/* Skills Grid */
.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 25px;
}

/* Skill Card */
.skill-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.skill-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 156, 211, 0.15);
}

.skill-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
}

.skill-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
}

.skill-status {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    gap: 4px;
    background: rgba(255,255,255,0.2);
    color: #fff;
}

.skill-content {
    padding: 20px;
}

.skill-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 10px 0;
    color: #212529;
}

.skill-content p {
    color: #6c757d;
    margin-bottom: 15px;
    line-height: 1.5;
}

.skill-details {
    margin-bottom: 15px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    font-size: 0.9rem;
    color: #6c757d;
}

.detail-item i {
    color: #4B9CD3;
    width: 14px;
}

.skill-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
}

.tag {
    background: #e9ecef;
    color: #495057;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.skill-actions {
    display: flex;
    gap: 8px;
    padding: 0 20px 20px;
}

/* Buttons */
.btn-primary {
    background: #4B9CD3;
    border-color: #4B9CD3;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background: #3a7bb3;
    border-color: #3a7bb3;
    transform: translateY(-1px);
}

.btn-outline-primary {
    color: #4B9CD3;
    border-color: #4B9CD3;
    background: transparent;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
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
    padding: 6px 12px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    color: #fff;
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
    background: transparent;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: #fff;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    grid-column: 1 / -1;
}

.empty-icon {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #212529;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6c757d;
    margin-bottom: 20px;
}

/* Modal Styles */
.modal-content {
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.modal-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
    border-radius: 8px 8px 0 0;
    border-bottom: none;
}

.modal-title {
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #212529;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label i {
    color: #4B9CD3;
    width: 16px;
}

.required {
    color: #dc3545;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background: #fff;
}

.form-control:focus {
    border-color: #4B9CD3;
    box-shadow: 0 0 0 0.2rem rgba(75, 156, 211, 0.25);
    outline: none;
}

/* Floating Alerts */
.floating-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    min-width: 300px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .header-title {
        font-size: 1.5rem;
    }
    
    .header-stats {
        justify-content: center;
    }
    
    .skills-header-row {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .skills-grid {
        grid-template-columns: 1fr;
    }
    
    .skill-actions {
        flex-direction: column;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .skills-header {
        padding: 30px 0;
    }
    
    .skills-section {
        padding: 20px 0;
    }
    
    .header-stats {
        flex-direction: column;
        gap: 15px;
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

    // Add skill form submission
    const addSkillForm = document.getElementById('addSkillForm');
    if (addSkillForm) {
        addSkillForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.classList.add('btn-loading');
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Adding...';
        });
    }

    // Edit skill form submission
    const editSkillForm = document.getElementById('editSkillForm');
    if (editSkillForm) {
        editSkillForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.classList.add('btn-loading');
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
        });
    }
});

// Edit Skill Function
function editSkill(skillId) {
    // Show loading state
    Swal.fire({
        title: 'Loading...',
        text: 'Fetching skill details',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Fetch skill data
    fetch(`/dashboard/profile/skills/${skillId}/edit`)
        .then(response => response.json())
        .then(data => {
            Swal.close();
            
            if (data.success) {
                // Populate the edit modal with skill data
                document.getElementById('edit_skill_name').value = data.skill.name;
                document.getElementById('edit_skill_category').value = data.skill.category;
                document.getElementById('edit_skill_level').value = data.skill.level;
                document.getElementById('edit_experience_years').value = data.skill.experience_years || '';
                document.getElementById('edit_skill_description').value = data.skill.description;
                document.getElementById('edit_hourly_rate').value = data.skill.hourly_rate || '';
                
                // Set the form action URL
                document.getElementById('editSkillForm').action = `/dashboard/profile/skills/${skillId}`;
                
                // Show the edit modal
                $('#editSkillModal').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to load skill details'
                });
            }
        })
        .catch(error => {
            Swal.close();
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to load skill details. Please try again.'
            });
        });
}

// Delete Skill Function with SweetAlert
function deleteSkill(skillId, skillName) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete the skill "${skillName}". This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete your skill',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send delete request
            fetch(`/dashboard/profile/skills/${skillId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Your skill has been deleted successfully.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        // Reload the page to reflect changes
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to delete skill'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete skill. Please try again.'
                });
            });
        }
    });
}

// View Skill Function
function viewSkill(skillId) {
    // Add your view skill logic here
    console.log('Viewing skill:', skillId);
    // You can implement a modal or redirect to a detailed view
}

// Handle edit form submission
document.getElementById('editSkillForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.classList.add('btn-loading');
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.classList.remove('btn-loading');
        submitBtn.innerHTML = originalText;
        
        if (data.success) {
            $('#editSkillModal').modal('hide');
            
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: 'Your skill has been updated successfully.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Failed to update skill'
            });
        }
    })
    .catch(error => {
        submitBtn.classList.remove('btn-loading');
        submitBtn.innerHTML = originalText;
        
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to update skill. Please try again.'
        });
    });
});
</script>

@endsection 