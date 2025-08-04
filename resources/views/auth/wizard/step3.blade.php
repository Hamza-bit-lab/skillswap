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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Progress Bar -->
            <div class="wizard-progress mt-4 mb-4">
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

            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                </h1>
                <p class="text-muted">Step 3: Professional Experience</p>
            </div>
            
            <div class="card shadow">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.step3.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="years_of_experience">{{ __('Years of Professional Experience') }} <span class="text-danger">*</span></label>
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
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="current_role">{{ __('Current Role/Position') }}</label>
                            <input id="current_role" type="text" class="form-control @error('current_role') is-invalid @enderror" name="current_role" value="{{ old('current_role') }}" placeholder="e.g., Senior Developer, Freelance Designer, Marketing Manager">
                            @error('current_role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company">{{ __('Current Company/Organization') }}</label>
                            <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" placeholder="e.g., Google, Freelance, Self-employed">
                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="portfolio_url">{{ __('Portfolio URL') }}</label>
                            <input id="portfolio_url" type="url" class="form-control @error('portfolio_url') is-invalid @enderror" name="portfolio_url" value="{{ old('portfolio_url') }}" placeholder="https://yourportfolio.com">
                            <small class="form-text text-muted">Showcase your work to potential skill exchange partners</small>
                            @error('portfolio_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="linkedin">{{ __('LinkedIn Profile') }}</label>
                            <input id="linkedin" type="url" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/yourprofile">
                            @error('linkedin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="github">{{ __('GitHub Profile') }}</label>
                            <input id="github" type="url" class="form-control @error('github') is-invalid @enderror" name="github" value="{{ old('github') }}" placeholder="https://github.com/yourusername">
                            <small class="form-text text-muted">Great for developers to showcase their code</small>
                            @error('github')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="website">{{ __('Personal Website') }}</label>
                            <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" placeholder="https://yourwebsite.com">
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('register.back', 3) }}" class="btn btn-outline-secondary btn-block">
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

</body>

</html> 