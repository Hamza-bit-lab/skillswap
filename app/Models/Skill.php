<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'level',
        'is_verified',
        'is_featured',
        'hourly_rate',
        'portfolio_url',
        'certifications',
        'experience_years',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'hourly_rate' => 'decimal:2',
        'experience_years' => 'integer',
    ];

    /**
     * Get the user that owns the skill
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the exchanges that use this skill
     */
    public function exchanges()
    {
        return $this->hasMany(Exchange::class);
    }

    /**
     * Get the reviews for this skill
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Scope for verified skills
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for featured skills
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for skills by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get average rating for this skill
     */
    public function getAverageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get total reviews count for this skill
     */
    public function getReviewsCount()
    {
        return $this->reviews()->count();
    }
}
