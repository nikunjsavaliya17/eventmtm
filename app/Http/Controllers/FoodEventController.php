<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodEventController extends Controller
{
    public function index()
    {
        return view('food_events.index');
    }

    public function add()
    {
        return view('food_events.form');
    }
}
