<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    public function index()
    {
        return view('food_menu.index');
    }

    public function add()
    {
        return view('food_menu.form');
    }
}
