<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getUsersFromQuery(Request $request)
    {
        $query = $request->input('users-query');
        return User::where('name', 'LIKE', '%' . $query . '%')->get();
    }
}
