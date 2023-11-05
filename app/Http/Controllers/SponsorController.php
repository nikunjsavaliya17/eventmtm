<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\SponsorType;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $records = Sponsor::query()->with(['typeDetail'])->paginate(25);
        return view('sponsors.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        $sponsorTypes = SponsorType::pluck('title', 'sponsor_type_id')->toArray();
        return view('sponsors.form', compact('formMode', 'sponsorTypes'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'company_name' => 'required|unique:sponsors,company_name',
            'sponsor_type_id' => 'required',
            'contact_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric|digits:10',
        ];
        if ($request->filled('update_id')) {
            $validateArr['company_name'] .= ',' . $request->filled('update_id') . ',sponsor_id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['logo'])){
            $requestData['logo'] = uploadFile($requestData['logo'], 'sponsor');
        }
        if (isset($requestData['update_id'])) {
            $item = Sponsor::where('sponsor_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            Sponsor::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('sponsors.index')->with('success', $message);
    }

    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $formMode = 'Edit';
        $sponsorTypes = SponsorType::pluck('title', 'sponsor_type_id')->toArray();
        return view('sponsors.form', compact('formMode', 'sponsor', 'sponsorTypes'));
    }

    public function update_order(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Sponsor::findOrFail($requestData['record_id']);
        $record->update(['display_order' => $requestData['display_order']]);
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Sponsor::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('sponsors.index')->with('success', 'Data Deleted Successfully');
    }
}
