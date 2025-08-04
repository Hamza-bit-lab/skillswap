<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id'
    ];

    /**
     * Get the user that owns the portfolio item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
