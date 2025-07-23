<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    protected $fillable = [
        'business_owner_id', 'business_name', 'description', 'photos', 'services_offered', 'type_of_business',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(BusinessOwner::class, 'business_owner_id');
    }
}
