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
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'phone_number',
        'gender',
        'birthdate',
        'email',
        'email_verified_at',
        'password',
        'current_team_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    /**
     * Get the routines for the user.
     */
    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

    /**
     * Define la relación "hasMany" con el modelo Follower.
     */
    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    /**
     * Define la relación "hasMany" con el modelo Following.
     */
    public function followings()
    {
        return $this->hasMany(Following::class, 'user_id');
    }

    /**
     * Define la relación "hasMany" con el modelo Log.
     */
    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }
}
