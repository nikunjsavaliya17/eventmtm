<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodPartnerController extends Controller
{
    public function index()
    {
        return view('food_partners.index');
    }

    public function add()
    {
        return view('food_partners.form');
    }
}
