<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'body',
        'admin_id',
        'slug'
    ];

    // public static function getCourseFromSlug($slug)
    // {
    //     return Course::where('slug', $slug)->firstOrFail();
    // }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function hasUser($userId): bool
    {
        return ($this->belongsToMany(User::class, 'courses_users', 'course_id', 'user_id')->get()->contains('id', $userId));
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'courses_users', 'course_id', 'user_id');
    }

    public function publication()
    {
        return $this->hasOne(Publication::class);
    }

    public function publish()
    {
        // check if the course already is published
        if ($this->hasPublication())
           // return error code if the course already exists
            return ["failed to publish course: course already is published"];
            
        Publication::create(['course_id' => $this->id, 'price' => 0, 'is_active' => 1]);
        return ["The course is succesfully published!"];
    }

    public function unPublish()
    {
        // Check if course already is unpublished
        if (! $this->hasPublication())
            return ["The course already is unpublished"];

        // Unpublish the course
        $this->hasOne(Publication::class)->delete();
        return ["The course is succesfully unpublished!"];
    }

    public function hasPublication() :bool
    {
        return ( $this->hasOne(Publication::class)->exists() );
    }

    public function getPublicationOrFail()
    {
        $publication = $this->publication;
        if ($publication != null)
            return $publication;
        abort(404);
    }
}
