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
    public function getCourseFromSlug($slug)
    {
        return Course::where('slug', $slug)->firstOrFail();
    }

    public function edit($course)
    {
        return view('course-edit', ['course' => $course]);
    }

    public function manageUsers(Course $course)
    {
        $publication = $course->getPublicationOrFail();
        $users = $publication->users;
        return view('admin.course-users', ['course' => $publication->course, 'users' => $users]);
    }

    public function addUser(Request $request, Course $course)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $publication = $course->getPublicationOrFail();
        // check if user already is in course
        dd($publication);
        if ($publication->hasUser($userId))
            return ["User already registered in this course"];

        // add user in course
        $user->giveAccessToPublication($publication->id);
        
        return ["Success!"];
    }

    public function editCourse(Course $course)
    {
        return view('admin.edit-course', ['course' => $course]);
    }

    public function editPublishStatus(Request $request, $course)
    {
        $code = $request->input("course-status");
        if ($code == 1)
            return $course->publish();
            
        return $course->unpublish();
    }

    public function makeCourse()
    {
        return view('admin.make-course');
    }

    public function postCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:courses|max:255',
            'excerpt' => 'required|unique:courses',
            'slug' => 'required|unique:courses',
            'body' => 'required'
        ]);

        Course::create($request->all());

        session()->flash('success', 'succesfully posted a new course');

        return view('admin.make-course');
    }

    public function saveCourse(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:courses,title,' . $course->id,
            'excerpt' => 'required|unique:courses,excerpt,' . $course->id,
            'slug' => 'required|unique:courses,slug,' .  $course->id,
            'body' => 'required'
        ]);

        $course->update($request->all());

        return ["successfully updated the course"];
    }

    public function showCourse(Request $request, Course $course)
    {
        if (($course->hasPublication() && auth()->user()->hasPublication($course->publication->id))
            || auth()->user()->isAdmin())
            return view('course', ["course" => $course]);
        abort(404);
    }
}
