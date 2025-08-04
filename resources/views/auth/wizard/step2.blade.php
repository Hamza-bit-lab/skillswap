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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Progress Bar -->
            <div class="wizard-progress mt-4 mb-4">
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

            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                </h1>
                <p class="text-muted">Step 2: Education Information</p>
            </div>
            
            <div class="card shadow">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.step2.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="education_level">{{ __('Highest Education Level') }} <span class="text-danger">*</span></label>
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
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="field_of_study">{{ __('Field of Study') }}</label>
                            <input id="field_of_study" type="text" class="form-control @error('field_of_study') is-invalid @enderror" name="field_of_study" value="{{ old('field_of_study') }}" placeholder="e.g., Computer Science, Graphic Design, Marketing">
                            @error('field_of_study')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="institution">{{ __('Institution') }}</label>
                            <input id="institution" type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" value="{{ old('institution') }}" placeholder="University, College, or Training Center">
                            @error('institution')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="graduation_year">{{ __('Graduation Year') }}</label>
                            <select id="graduation_year" class="form-control @error('graduation_year') is-invalid @enderror" name="graduation_year">
                                <option value="">Select year</option>
                                @for($year = date('Y'); $year >= 1950; $year--)
                                    <option value="{{ $year }}" {{ old('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('graduation_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>{{ __('Certifications (Optional)') }}</label>
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
                                    <a href="{{ route('register.back', 2) }}" class="btn btn-outline-secondary btn-block">
                                        <i class="fa fa-arrow-left mr-2"></i> Previous
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary btn-block">
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

</body>

</html> 