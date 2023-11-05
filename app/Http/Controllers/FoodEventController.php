<?php

namespace App\Http\Controllers;

use App\Models\FoodPartner;
use App\Models\FoodPartnerEvent;
use Illuminate\Http\Request;

class FoodEventController extends Controller
{
    public function index()
    {
        $records = FoodPartnerEvent::query()->with(['foodPartnerDetail'])->paginate(25);
        return view('food_events.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        $foodPartners = FoodPartner::pluck('company_name', 'food_partner_id')->toArray();
        return view('food_events.form', compact('formMode', 'foodPartners'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required|unique:food_partner_events,title',
        ];
        if ($request->filled('update_id')) {
            $validateArr['title'] .= ',' . $request->filled('update_id') . ',food_partner_event_id';
        }
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['update_id'])) {
            $item = FoodPartnerEvent::where('food_partner_event_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            FoodPartnerEvent::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('food_events.index')->with('success', $message);
    }

    public function edit($id)
    {
        $foodEvent = FoodPartnerEvent::findOrFail($id);
        $formMode = 'Edit';
        $foodPartners = FoodPartner::pluck('company_name', 'food_partner_id')->toArray();
        return view('food_events.form', compact('formMode', 'foodEvent', 'foodPartners'));
    }

    public function update_order(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodPartnerEvent::findOrFail($requestData['record_id']);
        $record->update(['display_order' => $requestData['display_order']]);
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodPartnerEvent::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('food_events.index')->with('success', 'Data Deleted Successfully');
    }
}
