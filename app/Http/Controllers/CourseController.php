<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursesUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    private function getCourseFromSlug($slug) :Course 
    {
        return Course::where('slug', $slug)->firstOrFail();
    }
    
    public function manageUsers($slug)
    {
        $course = $this->getCourseFromSlug($slug);
        $users = $course->users;
        return view('admin.course-users', ['course' => $course, 'users' => $users]);
    }

    public function addUser(Request $request, string $slug)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $course = $this->getCourseFromSlug($slug);
        
        // check if user already is in course
        if ($course->hasUser($userId))
            return ["User already registered in this course"];

        // add user in course
        CoursesUser::create(
            [
                'user_id' => $userId,
                'course_id' => $course->id
            ]
        );
        
        return ["Success!"];
    }

    public function editPublishStatus(Request $request, string $slug)
    {
        $course = $this->getCourseFromSlug($slug);
        $code = $request->input("course-status");
        if ($code == 1)
            return $course->publish();
            
        return $course->unpublish();
    }

    public function makeCourse()
    {
        return view('admin.make-course');
    }

    public function saveCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:courses|max:255',
            'excerpt' => 'required|unique:courses',
            'slug' => 'required|unique:courses',
            'body' => 'required'
        ]);

        Course::create($request->all());

        return view('admin.make-course');
    }
}
