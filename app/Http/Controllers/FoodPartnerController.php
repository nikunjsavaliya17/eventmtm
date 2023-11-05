<?php

namespace App\Http\Controllers;

use App\Models\FoodPartner;
use Illuminate\Http\Request;

class FoodPartnerController extends Controller
{
    public function index()
    {
        $records = FoodPartner::query()->paginate(25);
        return view('food_partners.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('food_partners.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'company_name' => 'required|unique:food_partners,company_name',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone_number' => 'required|numeric|digits:10',
        ];
        if ($request->filled('update_id')) {
            $validateArr['company_name'] .= ',' . $request->filled('update_id') . ',food_partner_id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['logo'])){
            $requestData['logo'] = uploadFile($requestData['logo'], 'food_partner');
        }
        if (isset($requestData['password'])){
            $requestData['password'] = bcrypt($requestData['password']);
        }
        if (isset($requestData['update_id'])) {
            $item = FoodPartner::where('food_partner_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            FoodPartner::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('food_partners.index')->with('success', $message);
    }

    public function edit($id)
    {
        $foodPartner = FoodPartner::findOrFail($id);
        $formMode = 'Edit';
        return view('food_partners.form', compact('formMode', 'foodPartner'));
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodPartner::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('food_partners.index')->with('success', 'Data Deleted Successfully');
    }
}
