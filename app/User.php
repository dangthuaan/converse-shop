<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordReset;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role', 'email', 'password', 'is_ban'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }


    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    /**
     * Scope if user is Admin.
     *
     * @return Boolean
     */
    public function scopeIsAdmin()
    {
        return $this->role == 1;
    }

    /**
     * Scope if user is Manager.
     *
     * @return Boolean
     */
    public function scopeIsManager()
    {
        return $this->role == 2;
    }

    /**
     * Scope if user is Normal User.
     *
     * @return Boolean
     */
    public function scopeIsNormalUser()
    {
        return $this->role == 3;
    }
}
