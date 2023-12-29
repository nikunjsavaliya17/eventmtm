<?php

namespace App\Http\Controllers;

use App\Models\FoodPartner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FoodPartnerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = FoodPartner::query()->with(['createdByUser:user_id,name']);
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('food-partner-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch' . $item->food_partner_id . '"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus(' . $item->food_partner_id . ')" name="is_active_' . $item->food_partner_id . '" type="checkbox" ' . $checkedClass . ' class="form-check-input" id="customSwitch' . $item->food_partner_id . '" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->editColumn('created_by', function ($item) {
                    return $item->createdByUser->name ?? "---";
                })
                ->addColumn('actions', function ($item) use ($user) {
                    return view('food_partners.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('food_partners.index', compact('user'));
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
            $validateArr['company_name'] .= ',' . $request->get('update_id') . ',food_partner_id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        if (isset($requestData['logo'])) {
            $requestData['logo'] = uploadFile($requestData['logo'], FoodPartner::IMG_DIR);
        }
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        } else {
            unset($requestData['password']);
        }
        if (isset($requestData['update_id'])) {
            $item = FoodPartner::where('food_partner_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['created_by'] = auth()->user()->user_id;
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

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodPartner::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active') {
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        } else {
            $record->update(['display_order' => $requestData['display_order']]);
        }
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodPartner::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('food_partners.index')->with('success', 'Data Deleted Successfully');
    }
}
