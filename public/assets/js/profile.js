// Profile Management
document.addEventListener('DOMContentLoaded', function() {
    // Skills Management
    const addSkillBtn = document.querySelector('.add-skill');
    const skillsContainer = document.querySelector('.skills-container');

    // Add Skill Modal
    const addSkillModal = new bootstrap.Modal(document.getElementById('addSkillModal'));
    const addSkillForm = document.getElementById('addSkillForm');

    if (addSkillForm) {
        addSkillForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('{{ route('user.skills.add') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Delete Skill
    document.querySelectorAll('.delete-skill').forEach(button => {
        button.addEventListener('click', function() {
            const skillId = this.dataset.skillId;
            if (confirm('Are you sure you want to delete this skill?')) {
                fetch(`/profile/skills/${skillId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`skill-${skillId}`).remove();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });

    // Portfolio Management
    const addPortfolioBtn = document.querySelector('.add-portfolio');
    const portfolioGrid = document.querySelector('.portfolio-grid');

    // Delete Portfolio Item
    document.querySelectorAll('.delete-portfolio').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            if (confirm('Are you sure you want to delete this portfolio item?')) {
                fetch(`/profile/portfolio/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`portfolio-${itemId}`).remove();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
