<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'price', 'is_active'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'publication_user', 'publication_id', 'user_id');
    }

    public function hasUser($userId) :bool
    {
        return $this->users->where('user_id', $userId)->exists();
    }

}
