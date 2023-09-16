<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorTypeController extends Controller
{
    public function index()
    {
        return view('sponsor_types.index');
    }

    public function add()
    {
        return view('sponsor_types.form');
    }
}
