<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'business_owner_id',
        'rating',
        'title',
        'comment',
        'category',
        'is_flagged',
        'is_public',
        'user_name'
    ];


    public function owner()
    {
        return $this->belongsTo(BusinessOwner::class, 'business_owner_id');
    }
}
