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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Progress Bar -->
            <div class="wizard-progress mt-4 mb-4">
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

            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                </h1>
                <p class="text-muted">Step 4: Your Skills</p>
            </div>
            
            <div class="card shadow">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.step4.store') }}">
                        @csrf

                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            <strong>Add your skills!</strong> These are the skills you can offer to other members in exchange for their skills.
                        </div>

                        <div id="skills-container">
                            <div class="skill-item mb-4 p-3 border rounded">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Skill Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="skills[0][name]" placeholder="e.g., Web Development, Graphic Design" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category <span class="text-danger">*</span></label>
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
                                            <label>Skill Level <span class="text-danger">*</span></label>
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
                                            <label>Years of Experience</label>
                                            <input type="number" class="form-control" name="skills[0][experience_years]" min="0" max="50" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="skills[0][description]" rows="2" placeholder="Brief description of your expertise in this skill..."></textarea>
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
                                    <a href="{{ route('register.back', 4) }}" class="btn btn-outline-secondary btn-block">
                                        <i class="fa fa-arrow-left mr-2"></i> Previous
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-check mr-2"></i> Complete Registration
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">Almost done! Complete your profile to start exchanging skills.</p>
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Skill #${skillIndex + 1}</h6>
                <button type="button" class="btn btn-outline-danger btn-sm remove-skill">
                    <i class="fa fa-times"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Skill Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="skills[${skillIndex}][name]" placeholder="e.g., Web Development, Graphic Design" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Category <span class="text-danger">*</span></label>
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
                        <label>Skill Level <span class="text-danger">*</span></label>
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
                        <label>Years of Experience</label>
                        <input type="number" class="form-control" name="skills[${skillIndex}][experience_years]" min="0" max="50" placeholder="0">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="skills[${skillIndex}][description]" rows="2" placeholder="Brief description of your expertise in this skill..."></textarea>
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

</body>

</html> 