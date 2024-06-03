<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasFactory, Notifiable, Searchable;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


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

    // Usuarios que este usuario sigue
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
    }

    // Usuarios que siguen a este usuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function exerciseLogs()
    {
        return $this->hasMany(Exercise_Log::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        return $array;
    }
}
