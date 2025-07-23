<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = [
        'business_owner_id', 'token', 'expires_at',
    ];

    protected $dates = ['expires_at'];

    public function owner()
    {
        return $this->belongsTo(BusinessOwner::class, 'business_owner_id');
    }
}
