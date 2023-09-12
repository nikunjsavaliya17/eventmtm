<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventCompanyManagementController extends Controller
{
    public function index()
    {
        return view('event_company_management.index');
    }

    public function add()
    {
        return view('event_company_management.form');
    }
}
