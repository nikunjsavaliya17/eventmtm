<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);
        return view('admin_users.index', compact('users'));
    }

    public function add()
    {
        return view('admin_users.form');
    }
}
