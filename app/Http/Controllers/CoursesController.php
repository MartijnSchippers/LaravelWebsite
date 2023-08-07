<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Publication;
use Illuminate\Http\Request;


class CoursesController extends Controller
{
    public function show()
    {
        if (auth()->user()->isAdmin())
            return view('admin.courses', ['courses' => Course::all()]);
        
        return view('courses', ['publifications' => Publication::all()]);
    }


}
