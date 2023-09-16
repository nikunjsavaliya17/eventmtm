<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorshipManagementController extends Controller
{
    public function index()
    {
        return view('sponsorship_management.index');
    }

    public function add()
    {
        return view('sponsorship_management.form');
    }
}
