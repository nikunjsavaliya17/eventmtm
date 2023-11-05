<?php

namespace App\Http\Controllers;

use App\Models\SponsorType;
use Illuminate\Http\Request;

class SponsorTypeController extends Controller
{
    public function index()
    {
        $records = SponsorType::query()->paginate(25);
        return view('sponsor_types.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('sponsor_types.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required|unique:food_types,title',
        ];
        if ($request->filled('update_id')) {
            $validateArr['title'] .= ',' . $request->filled('update_id') . ',sponsor_type_id';
        }
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['update_id'])) {
            $item = SponsorType::where('sponsor_type_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            SponsorType::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('sponsor_types.index')->with('success', $message);
    }

    public function edit($id)
    {
        $sponsorType = SponsorType::findOrFail($id);
        $formMode = 'Edit';
        return view('sponsor_types.form', compact('formMode', 'sponsorType'));
    }

    public function update_order(Request $request)
    {
        $requestData = $request->except('_token');
        $record = SponsorType::findOrFail($requestData['record_id']);
        $record->update(['display_order' => $requestData['display_order']]);
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = SponsorType::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('sponsor_types.index')->with('success', 'Data Deleted Successfully');
    }
}
