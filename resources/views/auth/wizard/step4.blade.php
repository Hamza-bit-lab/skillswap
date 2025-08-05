<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>SkillSwap - Join Us (Step 4)</title>
</head>

<body style="background: #f8f9fa;">

<!-- Registration Container -->
<div class="registration-container">
    <!-- Header Section -->
    <div class="registration-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="registration-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="header-content">
                            <h1 class="header-title">
                                <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                            </h1>
                            <p class="header-subtitle">Join our community of skilled professionals and start exchanging your expertise</p>
                            <div class="header-features">
                                <div class="feature-item">
                                    <i class="fa fa-star"></i>
                                    <span>Showcase your skills</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-handshake-o"></i>
                                    <span>Connect with others</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-rocket"></i>
                                    <span>Start exchanging</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="registration-form-container">
                            <!-- Progress Bar -->
                            <div class="wizard-progress mb-4">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress-steps">
                                    <div class="step completed">
                                        <div class="step-number">1</div>
                                        <div class="step-label">Personal Info</div>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-number">2</div>
                                        <div class="step-label">Education</div>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-number">3</div>
                                        <div class="step-label">Experience</div>
                                    </div>
                                    <div class="step active">
                                        <div class="step-number">4</div>
                                        <div class="step-label">Skills</div>
                                    </div>
                                </div>
                            </div>

                            <div class="registration-card">
                                <div class="registration-card-header">
                                    <h3>Step 4: Your Skills</h3>
                                    <p>Add the skills you can offer to other members</p>
                                </div>
                                
                                <div class="registration-card-body">
                                    <div class="alert alert-info mb-4">
                                        <i class="fa fa-info-circle"></i>
                                        <strong>Add your skills!</strong> These are the skills you can offer to other members in exchange for their skills.
                                    </div>

                                    <form method="POST" action="{{ route('register.step4.store') }}">
                                        @csrf

                                        <div id="skills-container">
                                            <div class="skill-item mb-4 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                <i class="fa fa-star"></i> Skill Name <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" name="skills[0][name]" placeholder="e.g., Web Development, Graphic Design" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                <i class="fa fa-tags"></i> Category <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control" name="skills[0][category]" required>
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
                                                            <label class="form-label">
                                                                <i class="fa fa-level-up"></i> Skill Level <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control" name="skills[0][level]" required>
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
                                                            <label class="form-label">
                                                                <i class="fa fa-clock-o"></i> Experience Years
                                                            </label>
                                                            <input type="number" class="form-control" name="skills[0][experience_years]" min="0" max="50" placeholder="Years of experience">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        <i class="fa fa-align-left"></i> Description <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control" name="skills[0][description]" rows="3" placeholder="Describe your skill, what you can offer, and your expertise level..." required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        <i class="fa fa-dollar"></i> Hourly Rate (Optional)
                                                    </label>
                                                    <input type="number" class="form-control" name="skills[0][hourly_rate]" min="0" step="0.01" placeholder="Your preferred hourly rate">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center mb-4">
                                            <button type="button" class="btn btn-outline-primary" id="add-skill">
                                                <i class="fa fa-plus"></i> Add Another Skill
                                            </button>
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{ route('register.back', 4) }}" class="btn btn-outline-secondary btn-block btn-lg">
                                                        <i class="fa fa-arrow-left mr-2"></i> Previous
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                        <i class="fa fa-check"></i> Complete Registration
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addSkillBtn = document.getElementById('add-skill');
    const skillsContainer = document.getElementById('skills-container');
    let skillIndex = 1;

    addSkillBtn.addEventListener('click', function() {
        const skillItem = document.createElement('div');
        skillItem.className = 'skill-item mb-4 p-3 border rounded';
        skillItem.innerHTML = `
            <div class="skill-header d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Skill #${skillIndex + 1}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm remove-skill">
                    <i class="fa fa-times"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-star"></i> Skill Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="skills[${skillIndex}][name]" placeholder="e.g., Web Development, Graphic Design" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa fa-tags"></i> Category <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" name="skills[${skillIndex}][category]" required>
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
                        <label class="form-label">
                            <i class="fa fa-level-up"></i> Skill Level <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" name="skills[${skillIndex}][level]" required>
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
                        <label class="form-label">
                            <i class="fa fa-clock-o"></i> Experience Years
                        </label>
                        <input type="number" class="form-control" name="skills[${skillIndex}][experience_years]" min="0" max="50" placeholder="Years of experience">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa fa-align-left"></i> Description <span class="text-danger">*</span>
                </label>
                <textarea class="form-control" name="skills[${skillIndex}][description]" rows="3" placeholder="Describe your skill, what you can offer, and your expertise level..." required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <i class="fa fa-dollar"></i> Hourly Rate (Optional)
                </label>
                <input type="number" class="form-control" name="skills[${skillIndex}][hourly_rate]" min="0" step="0.01" placeholder="Your preferred hourly rate">
            </div>
        `;
        skillsContainer.appendChild(skillItem);
        skillIndex++;
    });

    skillsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-skill')) {
            e.target.closest('.skill-item').remove();
        }
    });
});
</script>

<style>
.registration-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow-x: hidden;
}

.registration-header-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
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

.registration-header-content {
    position: relative;
    z-index: 3;
    width: 100%;
}

.header-content {
    color: white;
    padding: 2rem 0;
}

.header-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.header-subtitle {
    font-size: 1.25rem;
    font-weight: 400;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.header-features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.1rem;
    opacity: 0.9;
}

.feature-item i {
    font-size: 1.5rem;
    color: #14a800;
    background: rgba(255,255,255,0.2);
    padding: 0.5rem;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.registration-form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 2rem;
    margin: 0 auto;
    max-width: 100%;
}

.registration-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 100%;
    max-width: 800px;
    margin: 0 auto 2rem auto;
}

.registration-card-header {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.registration-card-header h3 {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.registration-card-header p {
    opacity: 0.9;
    margin: 0;
}

.registration-card-body {
    padding: 2rem;
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

.form-control::placeholder {
    color: #6c757d;
    opacity: 0.7;
}

.btn-primary {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    border: none;
    border-radius: 10px;
    padding: 0.875rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(20, 168, 0, 0.3);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
    border-radius: 10px;
    padding: 0.875rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
}

.btn-outline-primary {
    border: 2px solid #14a800;
    color: #14a800;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: #14a800;
    border-color: #14a800;
    color: white;
}

.btn-outline-danger {
    border: 2px solid #dc3545;
    color: #dc3545;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

/* Skill Item Styles */
.skill-item {
    background: white;
    border: 1px solid #e9ecef !important;
    transition: all 0.3s ease;
}

.skill-item:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-color: #14a800 !important;
}

.skill-header {
    border-bottom: 1px solid #e9ecef;
    padding-bottom: 1rem;
}

.skill-header h6 {
    color: #14a800;
    font-weight: 600;
}

/* Progress Bar Styles */
.wizard-progress {
    width: 100%;
    max-width: 800px;
}

.wizard-progress .progress {
    height: 8px;
    border-radius: 10px;
    background-color: rgba(255,255,255,0.3);
    margin-bottom: 20px;
}

.wizard-progress .progress-bar {
    border-radius: 10px;
    transition: width 0.3s ease;
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: rgba(255,255,255,0.3);
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    background: transparent;
    padding: 0 10px;
}

.step-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.3);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.step-label {
    font-size: 12px;
    color: rgba(255,255,255,0.8);
    text-align: center;
    font-weight: 500;
    transition: color 0.3s ease;
}

.step.active .step-number {
    background-color: #14a800;
    color: white;
    box-shadow: 0 0 0 3px rgba(20, 168, 0, 0.3);
}

.step.active .step-label {
    color: white;
    font-weight: 600;
}

.step.completed .step-number {
    background-color: #14a800;
    color: white;
}

.step.completed .step-label {
    color: white;
}

@media (max-width: 991px) {
    .header-title {
        font-size: 2.5rem;
    }
    
    .header-subtitle {
        font-size: 1.1rem;
    }
    
    .registration-form-container {
        min-height: auto;
        padding: 1rem 0;
    }
    
    .registration-card {
        margin: 1rem;
    }
}

@media (max-width: 576px) {
    .header-title {
        font-size: 2rem;
    }
    
    .header-features {
        gap: 0.75rem;
    }
    
    .feature-item {
        font-size: 1rem;
    }
    
    .registration-card-header {
        padding: 1.5rem;
    }
    
    .registration-card-body {
        padding: 1.5rem;
    }
}
</style>

</body>

</html> 
</html> 