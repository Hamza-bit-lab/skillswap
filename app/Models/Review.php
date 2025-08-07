<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_id',
        'reviewed_user_id',
        'exchange_id',
        'skill_id',
        'rating',
        'title',
        'comment',
        'is_verified',
        'is_approved',
        'is_rejected',
        'review_type',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'is_approved' => 'boolean',
        'is_rejected' => 'boolean',
    ];

    /**
     * Get the reviewer user
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Get the reviewed user
     */
    public function reviewedUser()
    {
        return $this->belongsTo(User::class, 'reviewed_user_id');
    }

    /**
     * Get the exchange this review belongs to
     */
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    /**
     * Get the skill this review is for
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    /**
     * Scope for verified reviews
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for reviews by rating
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope for positive reviews (4-5 stars)
     */
    public function scopePositive($query)
    {
        return $query->where('rating', '>=', 4);
    }

    /**
     * Get the star rating display
     */
    public function getStarRating()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Check if review is positive
     */
    public function isPositive()
    {
        return $this->rating >= 4;
    }

    /**
     * Check if review is negative
     */
    public function isNegative()
    {
        return $this->rating <= 2;
    }
}
