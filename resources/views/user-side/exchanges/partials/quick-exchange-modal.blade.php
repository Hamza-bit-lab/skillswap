<div class="quick-exchange-form">
    <div class="exchange-preview mb-4">
        <div class="exchange-preview-header">
            <h6><i class="fa fa-exchange"></i> Exchange Proposal</h6>
        </div>
        <div class="exchange-preview-content">
            <div class="exchange-participants">
                <div class="participant">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                         alt="{{ auth()->user()->name }}" class="participant-avatar">
                    <div class="participant-info">
                        <div class="participant-name">{{ auth()->user()->name }}</div>
                        <div class="participant-role">You (Initiator)</div>
                    </div>
                </div>
                <div class="exchange-arrow">
                    <i class="fa fa-exchange"></i>
                </div>
                <div class="participant">
                    <img src="{{ $targetSkill->user->avatar ? asset('storage/' . $targetSkill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                         alt="{{ $targetSkill->user->name }}" class="participant-avatar">
                    <div class="participant-info">
                        <div class="participant-name">{{ $targetSkill->user->name }}</div>
                        <div class="participant-role">Skill Owner</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="quickExchangeForm" onsubmit="submitQuickExchange(); return false;">
        @csrf
        <input type="hidden" name="target_skill_id" value="{{ $targetSkill->id }}">
        
        <!-- Exchange Details -->
        <div class="form-group">
            <label for="title" class="form-label">
                <i class="fa fa-pencil"></i> Exchange Title <span class="text-danger">*</span>
            </label>
            <input type="text" 
                   class="form-control" 
                   id="title" 
                   name="title" 
                   placeholder="e.g., Web Development for Logo Design"
                   required>
            <small class="form-text text-muted">Give your exchange a clear, descriptive title</small>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">
                <i class="fa fa-align-left"></i> Exchange Description <span class="text-danger">*</span>
            </label>
            <textarea class="form-control" 
                      id="description" 
                      name="description" 
                      rows="4"
                      placeholder="Describe what you want to exchange in detail. Be specific about what you need and what you can offer."
                      required></textarea>
            <small class="form-text text-muted">Minimum 20 characters. Be specific about your requirements and offer.</small>
        </div>

        <!-- Skills Selection -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_skill_id" class="form-label">
                        <i class="fa fa-gift"></i> Your Skill to Offer <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" id="user_skill_id" name="user_skill_id" required>
                        <option value="">Select your skill to offer</option>
                        @foreach($userSkills as $skill)
                            <option value="{{ $skill->id }}">
                                {{ $skill->name }} ({{ ucfirst($skill->level) }})
                            </option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Choose which of your skills you want to offer in exchange</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa fa-search"></i> Skill You Want
                    </label>
                    <div class="form-control-plaintext">
                        <strong>{{ $targetSkill->name }}</strong>
                        <span class="badge badge-level level-{{ strtolower($targetSkill->level) }}">
                            {{ ucfirst($targetSkill->level) }}
                        </span>
                        <br>
                        <small class="text-muted">by {{ $targetSkill->user->name }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Details -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estimated_hours" class="form-label">
                        <i class="fa fa-clock-o"></i> Estimated Hours
                    </label>
                    <input type="number" 
                           class="form-control" 
                           id="estimated_hours" 
                           name="estimated_hours" 
                           min="1" 
                           max="200"
                           placeholder="e.g., 20">
                    <small class="form-text text-muted">How many hours do you think this will take?</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="communication_preference" class="form-label">
                        <i class="fa fa-comments"></i> Communication Preference
                    </label>
                    <select class="form-control" id="communication_preference" name="communication_preference">
                        <option value="">No preference</option>
                        <option value="chat">Chat/Messaging</option>
                        <option value="video">Video Call</option>
                        <option value="email">Email</option>
                        <option value="phone">Phone Call</option>
                    </select>
                    <small class="form-text text-muted">How would you prefer to communicate?</small>
                </div>
            </div>
        </div>

        <!-- Exchange Preview -->
        <div class="exchange-preview-details mt-4">
            <h6><i class="fa fa-eye"></i> Exchange Preview</h6>
            <div class="preview-content">
                <div class="preview-item">
                    <strong>You Offer:</strong>
                    <span id="previewUserSkill">Select your skill above</span>
                </div>
                <div class="preview-item">
                    <strong>You Receive:</strong>
                    <span>{{ $targetSkill->name }} ({{ ucfirst($targetSkill->level) }})</span>
                </div>
                <div class="preview-item">
                    <strong>From:</strong>
                    <span>{{ $targetSkill->user->name }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-actions mt-4">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fa fa-times"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-paper-plane"></i> Send Exchange Proposal
            </button>
        </div>
    </form>
</div>

<style>
.quick-exchange-form {
    padding: 20px 0;
}

.exchange-preview {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    border: 2px solid #e9ecef;
}

.exchange-preview-header h6 {
    margin: 0 0 15px 0;
    color: #333;
    font-weight: 600;
}

.exchange-participants {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.participant {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: white;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.participant-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.participant-info {
    text-align: center;
}

.participant-name {
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
}

.participant-role {
    font-size: 0.8rem;
    color: #6c757d;
}

.exchange-arrow {
    color: #14a800;
    font-size: 1.2rem;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-label i {
    margin-right: 5px;
    color: #14a800;
}

.badge-level {
    font-size: 0.7rem;
    padding: 2px 8px;
    border-radius: 10px;
    margin-left: 5px;
}

.level-beginner { background: #d4edda; color: #155724; }
.level-intermediate { background: #fff3cd; color: #856404; }
.level-advanced { background: #cce5ff; color: #004085; }
.level-expert { background: #f8d7da; color: #721c24; }

.exchange-preview-details {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    border: 1px solid #e9ecef;
}

.exchange-preview-details h6 {
    margin: 0 0 10px 0;
    color: #333;
    font-weight: 600;
}

.preview-content {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.preview-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 0;
    border-bottom: 1px solid #e9ecef;
}

.preview-item:last-child {
    border-bottom: none;
}

.preview-item strong {
    color: #333;
    font-size: 0.9rem;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

@media (max-width: 768px) {
    .exchange-participants {
        flex-direction: column;
        gap: 10px;
    }
    
    .exchange-arrow {
        transform: rotate(90deg);
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>

<script>
// Update preview when user skill is selected
document.getElementById('user_skill_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const previewElement = document.getElementById('previewUserSkill');
    
    if (this.value) {
        previewElement.textContent = selectedOption.textContent;
    } else {
        previewElement.textContent = 'Select your skill above';
    }
});
</script> 