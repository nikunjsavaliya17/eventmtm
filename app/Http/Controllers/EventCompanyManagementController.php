<?php

namespace App\Http\Controllers;

use App\Models\EventCompany;
use Illuminate\Http\Request;

class EventCompanyManagementController extends Controller
{
    public function index()
    {
        $records = EventCompany::query()->paginate(25);
        return view('event_company_management.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('event_company_management.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required|unique:event_companies,title',
            'address' => 'required',
            'email' => 'email|required|unique:event_companies,email',
            'phone_number' => 'required|numeric|digits:10',
            'contact_name' => 'required',
            'contact_email' => 'email|required',
            'contact_phone_number' => 'required|numeric|digits:10',
            'username' => 'required|unique:event_companies,username',
        ];
        if ($request->filled('update_id')) {
            $validateArr['title'] .= ',' . $request->filled('update_id') . ',event_company_id';
            $validateArr['email'] .= ',' . $request->filled('update_id') . ',event_company_id';
            $validateArr['username'] .= ',' . $request->filled('update_id') . ',event_company_id';
        } else {
            $validateArr['password'] = 'required';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        if (isset($requestData['update_id'])) {
            $item = EventCompany::where('event_company_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            EventCompany::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('event_company_management.index')->with('success', $message);
    }

    public function edit($id)
    {
        $eventCompany = EventCompany::findOrFail($id);
        $formMode = 'Edit';
        return view('event_company_management.form', compact('eventCompany', 'formMode'));
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = EventCompany::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('event_company_management.index')->with('success', 'Data Deleted Successfully');
    }
}
