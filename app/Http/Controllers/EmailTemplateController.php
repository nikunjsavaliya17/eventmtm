<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $email_templates = EmailTemplate::get();
        return view('email_templates.index', compact('email_templates'));
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $email_template = EmailTemplate::findOrFail($id);
        return view('email_templates.form', compact('email_template'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $email_template = EmailTemplate::findOrFail($id);
        $requestData = $request->all();
        $email_template->update($requestData);
        return to_route('email_templates')->with('success', 'Data Updated Successfully');
    }
}
