<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function index()
    {
        return view('food_types.index');
    }

    public function add()
    {
        return view('food_types.form');
    }
}
