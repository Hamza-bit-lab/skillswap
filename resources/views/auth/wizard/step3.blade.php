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
    <title>SkillSwap - Join Us (Step 3)</title>
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
                                    <i class="fa fa-briefcase"></i>
                                    <span>Share your experience</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span>Show your expertise level</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-building"></i>
                                    <span>Highlight your background</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="registration-form-container">
                            <!-- Progress Bar -->
                            <div class="wizard-progress mb-4">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <div class="step active">
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
                                    <h3>Step 3: Professional Experience</h3>
                                    <p>Tell us about your work experience and background</p>
                                </div>
                                
                                <div class="registration-card-body">
                                    <form method="POST" action="{{ route('register.step3.store') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="years_of_experience" class="form-label">
                                                <i class="fa fa-clock-o"></i> Years of Professional Experience <span class="text-danger">*</span>
                                            </label>
                                            <select id="years_of_experience" class="form-control @error('years_of_experience') is-invalid @enderror" name="years_of_experience" required>
                                                <option value="">Select years of experience</option>
                                                <option value="0" {{ old('years_of_experience') == '0' ? 'selected' : '' }}>0 (Just starting)</option>
                                                <option value="1" {{ old('years_of_experience') == '1' ? 'selected' : '' }}>1 year</option>
                                                <option value="2" {{ old('years_of_experience') == '2' ? 'selected' : '' }}>2 years</option>
                                                <option value="3" {{ old('years_of_experience') == '3' ? 'selected' : '' }}>3 years</option>
                                                <option value="4" {{ old('years_of_experience') == '4' ? 'selected' : '' }}>4 years</option>
                                                <option value="5" {{ old('years_of_experience') == '5' ? 'selected' : '' }}>5 years</option>
                                                <option value="6" {{ old('years_of_experience') == '6' ? 'selected' : '' }}>6-10 years</option>
                                                <option value="11" {{ old('years_of_experience') == '11' ? 'selected' : '' }}>11-15 years</option>
                                                <option value="16" {{ old('years_of_experience') == '16' ? 'selected' : '' }}>16+ years</option>
                                            </select>
                                            @error('years_of_experience')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="current_role" class="form-label">
                                                <i class="fa fa-user-md"></i> Current Role/Position
                                            </label>
                                            <input id="current_role" type="text" class="form-control @error('current_role') is-invalid @enderror" name="current_role" value="{{ old('current_role') }}" placeholder="e.g., Senior Developer, Freelance Designer, Marketing Manager">
                                            @error('current_role')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="company" class="form-label">
                                                <i class="fa fa-building"></i> Current Company/Organization
                                            </label>
                                            <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" placeholder="e.g., Google, Freelance, Self-employed">
                                            @error('company')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="industry" class="form-label">
                                                <i class="fa fa-industry"></i> Industry/Sector
                                            </label>
                                            <select id="industry" class="form-control @error('industry') is-invalid @enderror" name="industry">
                                                <option value="">Select your industry</option>
                                                <option value="Technology" {{ old('industry') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                                <option value="Design" {{ old('industry') == 'Design' ? 'selected' : '' }}>Design</option>
                                                <option value="Marketing" {{ old('industry') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                                <option value="Finance" {{ old('industry') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                <option value="Healthcare" {{ old('industry') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                                <option value="Education" {{ old('industry') == 'Education' ? 'selected' : '' }}>Education</option>
                                                <option value="Consulting" {{ old('industry') == 'Consulting' ? 'selected' : '' }}>Consulting</option>
                                                <option value="Freelance" {{ old('industry') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                                <option value="Other" {{ old('industry') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('industry')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="work_preferences" class="form-label">
                                                <i class="fa fa-cogs"></i> Work Preferences
                                            </label>
                                            <select id="work_preferences" class="form-control @error('work_preferences') is-invalid @enderror" name="work_preferences">
                                                <option value="">Select your work preference</option>
                                                <option value="Remote" {{ old('work_preferences') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                                <option value="On-site" {{ old('work_preferences') == 'On-site' ? 'selected' : '' }}>On-site</option>
                                                <option value="Hybrid" {{ old('work_preferences') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                <option value="Flexible" {{ old('work_preferences') == 'Flexible' ? 'selected' : '' }}>Flexible</option>
                                            </select>
                                            @error('work_preferences')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="availability" class="form-label">
                                                <i class="fa fa-calendar-check-o"></i> Availability
                                            </label>
                                            <select id="availability" class="form-control @error('availability') is-invalid @enderror" name="availability">
                                                <option value="">Select your availability</option>
                                                <option value="Full-time" {{ old('availability') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                                <option value="Part-time" {{ old('availability') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                                <option value="Freelance" {{ old('availability') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                                <option value="Weekends" {{ old('availability') == 'Weekends' ? 'selected' : '' }}>Weekends only</option>
                                                <option value="Evenings" {{ old('availability') == 'Evenings' ? 'selected' : '' }}>Evenings only</option>
                                            </select>
                                            @error('availability')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{ route('register.back', 3) }}" class="btn btn-outline-secondary btn-block btn-lg">
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