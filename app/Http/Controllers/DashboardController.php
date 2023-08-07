<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;

class DashboardController extends Controller
{
    public function view(Request $request)
    {
        $user = auth()->user();
        $notifications = [];
        if ($user->isAdmin())
            $notifications = AdminNotification::all();
        session()->flash('success', 'This is a test');
        return view('dashboard', ['notifications' => $notifications]);
    }
}
