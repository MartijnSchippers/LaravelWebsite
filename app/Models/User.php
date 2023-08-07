<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function giveAccessToPublication($publicationId)
    {
        $this->availablePublications()->attach($publicationId);
    }

    public function availablePublications()
    {
        return $this->belongsToMany(Publication::class, 'publication_user');//, 'courses_users', 'course_id', 'user_id');
    }

    public function isAdmin() :bool
    {
        return ($this->hasOne(Admin::class, 'user_id')->exists());
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function hasPublication($publicationId) :bool
    {
        return ($this->publications()->where('id', $publicationId)->exists());
    }

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'publication_user', 'user_id', 'publication_id');
    }

}
