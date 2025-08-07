<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'initiator_id',
        'participant_id',
        'initiator_skill_id',
        'participant_skill_id',
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'estimated_hours',
        'actual_hours',
        'terms',
        'is_featured',
        'is_urgent',
        'budget_range',
        'location_preference',
        'communication_preference',
        'initiator_marked_done',
        'participant_marked_done',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'terms' => 'array',
        'initiator_marked_done' => 'boolean',
        'participant_marked_done' => 'boolean',
    ];

    /**
     * Get the initiator user
     */
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    /**
     * Get the participant user
     */
    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    /**
     * Get the initiator's skill
     */
    public function initiatorSkill()
    {
        return $this->belongsTo(Skill::class, 'initiator_skill_id');
    }

    /**
     * Get the participant's skill
     */
    public function participantSkill()
    {
        return $this->belongsTo(Skill::class, 'participant_skill_id');
    }

    /**
     * Get the messages for this exchange
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the reviews for this exchange
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope for active exchanges
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress']);
    }

    /**
     * Scope for completed exchanges
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for featured exchanges
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for urgent exchanges
     */
    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }

    /**
     * Get the duration of the exchange
     */
    public function getDuration()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date->diffInDays($this->end_date);
        }
        return null;
    }

    /**
     * Check if exchange is active
     */
    public function isActive()
    {
        return in_array($this->status, ['pending', 'in_progress']);
    }

    /**
     * Check if exchange is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Check if both users have marked as done
     */
    public function bothMarkedDone()
    {
        return $this->initiator_marked_done && $this->participant_marked_done;
    }
    /**
     * Check if the given user has marked as done
     */
    public function hasUserMarkedDone($userId)
    {
        if ($userId == $this->initiator_id) return $this->initiator_marked_done;
        if ($userId == $this->participant_id) return $this->participant_marked_done;
        return false;
    }
}
