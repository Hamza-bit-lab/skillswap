<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
        'location',
        'avatar',
        'phone',
        'website',
        'linkedin',
        'github',
        'twitter',
        'is_admin',
        'is_verified',
        'rating',
        'total_exchanges',
        'completed_exchanges',
        'member_since',
        'last_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_verified' => 'boolean',
        'rating' => 'float',
        'member_since' => 'datetime',
        'last_active' => 'datetime',
    ];

    /**
     * Get the user's skills
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Get the user's exchanges as initiator
     */
    public function initiatedExchanges()
    {
        return $this->hasMany(Exchange::class, 'initiator_id');
    }

    /**
     * Get the user's exchanges as participant
     */
    public function participatedExchanges()
    {
        return $this->hasMany(Exchange::class, 'participant_id');
    }

    /**
     * Get all exchanges for the user
     */
    public function exchanges()
    {
        return $this->initiatedExchanges()->union($this->participatedExchanges());
    }

    /**
     * Get the user's messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the user's reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get reviews received by the user
     */
    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewed_user_id');
    }

    /**
     * Check if user is verified
     */
    public function isVerified()
    {
        return $this->is_verified;
    }

    /**
     * Get user's average rating
     */
    public function getAverageRating()
    {
        return $this->receivedReviews()->avg('rating') ?? 0;
    }

    /**
     * Get user's total exchanges count
     */
    public function getTotalExchangesCount()
    {
        return $this->initiatedExchanges()->count() + $this->participatedExchanges()->count();
    }

    /**
     * Get user's completed exchanges count
     */
    public function getCompletedExchangesCount()
    {
        return $this->initiatedExchanges()->where('status', 'completed')->count() + 
               $this->participatedExchanges()->where('status', 'completed')->count();
    }
}
