<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $records = Page::get();
        return view('custom_page.index', compact('records'));
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $page = Page::findOrFail($id);
        return view('custom_page.form', compact('page'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $record = Page::findOrFail($id);
        $requestData = $request->all();
        $record->update($requestData);
        return to_route('custom_page.index')->with('success', 'Data Updated Successfully');
    }
}
