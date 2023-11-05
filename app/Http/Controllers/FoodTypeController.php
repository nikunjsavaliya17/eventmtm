<?php

namespace App\Http\Controllers;

use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function index()
    {
        $records = FoodType::query()->paginate(25);
        return view('food_types.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('food_types.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required|unique:food_types,title',
        ];
        if ($request->filled('update_id')) {
            $validateArr['title'] .= ',' . $request->filled('update_id') . ',food_type_id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['update_id'])) {
            $item = FoodType::where('food_type_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            FoodType::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('food_types.index')->with('success', $message);
    }

    public function edit($id)
    {
        $foodType = FoodType::findOrFail($id);
        $formMode = 'Edit';
        return view('food_types.form', compact('formMode', 'foodType'));
    }

    public function update_order(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodType::findOrFail($requestData['record_id']);
        $record->update(['display_order' => $requestData['display_order']]);
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodType::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('food_types.index')->with('success', 'Data Deleted Successfully');
    }
}
