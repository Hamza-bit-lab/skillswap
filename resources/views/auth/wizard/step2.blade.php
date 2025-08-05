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
    <title>SkillSwap - Join Us (Step 2)</title>
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
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Showcase your education</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-certificate"></i>
                                    <span>Add your certifications</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-star"></i>
                                    <span>Build credibility</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="registration-form-container">
                            <!-- Progress Bar -->
                            <div class="wizard-progress mb-4">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress-steps">
                                    <div class="step completed">
                                        <div class="step-number">1</div>
                                        <div class="step-label">Personal Info</div>
                                    </div>
                                    <div class="step active">
                                        <div class="step-number">2</div>
                                        <div class="step-label">Education</div>
                                    </div>
                                    <div class="step">
                                        <div class="step-number">3</div>
                                        <div class="step-label">Experience</div>
                                    </div>
                                    <div class="step">
                                        <div class="step-number">4</div>
                                        <div class="step-label">Skills</div>
                                    </div>
                                </div>
                            </div>

                            <div class="registration-card">
                                <div class="registration-card-header">
                                    <h3>Step 2: Education Information</h3>
                                    <p>Tell us about your educational background</p>
                                </div>
                                
                                <div class="registration-card-body">
                                    <form method="POST" action="{{ route('register.step2.store') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="education_level" class="form-label">
                                                <i class="fa fa-graduation-cap"></i> Highest Education Level <span class="text-danger">*</span>
                                            </label>
                                            <select id="education_level" class="form-control @error('education_level') is-invalid @enderror" name="education_level" required>
                                                <option value="">Select your education level</option>
                                                <option value="High School" {{ old('education_level') == 'High School' ? 'selected' : '' }}>High School</option>
                                                <option value="Associate's Degree" {{ old('education_level') == 'Associate\'s Degree' ? 'selected' : '' }}>Associate's Degree</option>
                                                <option value="Bachelor's Degree" {{ old('education_level') == 'Bachelor\'s Degree' ? 'selected' : '' }}>Bachelor's Degree</option>
                                                <option value="Master's Degree" {{ old('education_level') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                                                <option value="Doctorate" {{ old('education_level') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                                                <option value="Self-taught" {{ old('education_level') == 'Self-taught' ? 'selected' : '' }}>Self-taught</option>
                                                <option value="Other" {{ old('education_level') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('education_level')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="field_of_study" class="form-label">
                                                <i class="fa fa-book"></i> Field of Study
                                            </label>
                                            <input id="field_of_study" type="text" class="form-control @error('field_of_study') is-invalid @enderror" name="field_of_study" value="{{ old('field_of_study') }}" placeholder="e.g., Computer Science, Graphic Design, Marketing">
                                            @error('field_of_study')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="institution" class="form-label">
                                                <i class="fa fa-university"></i> Institution
                                            </label>
                                            <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ old('institution') }}" placeholder="University, College, or Training Center">
                                            @error('institution')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="graduation_year" class="form-label">
                                                <i class="fa fa-calendar"></i> Graduation Year
                                            </label>
                                            <select id="graduation_year" class="form-control @error('graduation_year') is-invalid @enderror" name="graduation_year">
                                                <option value="">Select year</option>
                                                @for($year = date('Y'); $year >= 1950; $year--)
                                                    <option value="{{ $year }}" {{ old('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                @endfor
                                            </select>
                                            @error('graduation_year')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fa fa-certificate"></i> Certifications (Optional)
                                            </label>
                                            <div id="certifications-container">
                                                <div class="certification-item mb-2">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="certifications[]" placeholder="e.g., AWS Certified Developer, Google Analytics">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-danger remove-certification" style="display: none;">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-certification">
                                                <i class="fa fa-plus"></i> Add Certification
                                            </button>
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{ route('register.back', 2) }}" class="btn btn-outline-secondary btn-block btn-lg">
                                                        <i class="fa fa-arrow-left mr-2"></i> Previous
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                        Next Step <i class="fa fa-arrow-right ml-2"></i>
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
    const addCertificationBtn = document.getElementById('add-certification');
    const certificationsContainer = document.getElementById('certifications-container');

    addCertificationBtn.addEventListener('click', function() {
        const certificationItem = document.createElement('div');
        certificationItem.className = 'certification-item mb-2';
        certificationItem.innerHTML = `
            <div class="input-group">
                <input type="text" class="form-control" name="certifications[]" placeholder="e.g., AWS Certified Developer, Google Analytics">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger remove-certification">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        certificationsContainer.appendChild(certificationItem);
        
        // Show remove buttons if there are more than one certification
        const removeButtons = certificationsContainer.querySelectorAll('.remove-certification');
        removeButtons.forEach(btn => btn.style.display = 'inline-block');
    });

    certificationsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-certification')) {
            e.target.closest('.certification-item').remove();
            
            // Hide remove button if only one certification remains
            const certificationItems = certificationsContainer.querySelectorAll('.certification-item');
            if (certificationItems.length === 1) {
                certificationItems[0].querySelector('.remove-certification').style.display = 'none';
            }
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
    max-width: 600px;
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
    padding: 0.5rem 1rem;
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

/* Progress Bar Styles */
.wizard-progress {
    width: 100%;
    max-width: 600px;
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

/* Certification Item Styles */
.certification-item {
    transition: all 0.3s ease;
}

.certification-item:hover {
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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