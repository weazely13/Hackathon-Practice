<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BusinessOwner extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = ['password', 'remember_token'];

    public function profile()
    {
        return $this->hasOne(BusinessProfile::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function qrCodes()
    {
        return $this->hasMany(QrCode::class);
    }
}
