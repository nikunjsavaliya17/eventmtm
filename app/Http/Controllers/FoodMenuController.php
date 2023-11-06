<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    public function index()
    {
        $records = FoodMenu::query()->with(['typeDetail'])->paginate(25);
        return view('food_menu.index', compact('records'));
    }

    public function add()
    {
        $formMode = 'Add';
        $foodTypes = FoodType::pluck('title', 'food_type_id')->toArray();
        return view('food_menu.form', compact('formMode', 'foodTypes'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required',
        ];
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        $requestData['is_active'] = isset($requestData['is_active']) ? 1 : 0;
        if (isset($requestData['image'])){
            $requestData['image'] = uploadFile($requestData['image'], 'food_menu');
        }
        if (isset($requestData['update_id'])) {
            $item = FoodMenu::where('food_menu_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            FoodMenu::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('food_menu.index')->with('success', $message);
    }

    public function edit($id)
    {
        $foodMenu = FoodMenu::findOrFail($id);
        $formMode = 'Edit';
        $foodTypes = FoodType::pluck('title', 'food_type_id')->toArray();
        return view('food_menu.form', compact('formMode', 'foodMenu', 'foodTypes'));
    }

    public function update_order(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodMenu::findOrFail($requestData['record_id']);
        $record->update(['display_order' => $requestData['display_order']]);
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodMenu::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('food_menu.index')->with('success', 'Data Deleted Successfully');
    }
}
