<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventManagementController extends Controller
{
    public function index()
    {
        return view('event_management.index');
    }

    public function add()
    {
        return view('event_management.form');
    }
}
