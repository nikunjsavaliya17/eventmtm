<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCompany;
use Illuminate\Http\Request;

class EventManagementController extends Controller
{
    public function index()
    {
        $records = Event::query()->with(['eventCompanyDetail'])->paginate(25);
        return view('event_management.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        $companies = EventCompany::pluck('title', 'event_company_id')->toArray();
        return view('event_management.form', compact('formMode', 'companies'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'email|required',
            'contact_phone_number' => 'required|numeric|digits:10',
        ];
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['image'])) {
            $requestData['image'] = uploadFile($requestData['image'], 'event');
        }
        if (isset($requestData['update_id'])) {
            $item = Event::where('event_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            Event::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('event_management.index')->with('success', $message);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $formMode = 'Edit';
        $companies = EventCompany::pluck('title', 'event_company_id')->toArray();
        return view('event_management.form', compact('event', 'formMode', 'companies'));
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Event::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('event_management.index')->with('success', 'Data Deleted Successfully');
    }
}
