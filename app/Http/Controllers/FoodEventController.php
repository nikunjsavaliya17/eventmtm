<?php

namespace App\Http\Controllers;

use App\Models\FoodPartner;
use App\Models\FoodPartnerEvent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FoodEventController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = FoodPartnerEvent::query()->with(['createdByUser:user_id,name', 'foodPartnerDetail:food_partner_id,company_name']);
            if ($request->filled('food_partner_id')) {
                $data = $data->where('food_partner_id', $request->get('food_partner_id'));
            }
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('food-event-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch'.$item->food_partner_event_id.'"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus('.$item->food_partner_event_id.')" name="is_active_'.$item->food_partner_event_id.'" type="checkbox" '.$checkedClass.' class="form-check-input" id="customSwitch'.$item->food_partner_event_id.'" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->addColumn('food_partner', function ($item) {
                    return $item->foodPartnerDetail->company_name ?? "---";
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->editColumn('created_by', function ($item) {
                    return $item->createdByUser->name ?? "---";
                })
                ->addColumn('actions', function ($item) use ($user) {
                    return view('food_events.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('food_events.index', compact('user'));
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
            $validateArr['title'] .= ',' . $request->get('update_id') . ',food_partner_event_id';
        }
        $requestData = $request->except('_token');
        if (isset($requestData['update_id'])) {
            $item = FoodPartnerEvent::where('food_partner_event_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['created_by'] = auth()->user()->user_id;
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

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = FoodPartnerEvent::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active'){
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        }else{
            $record->update(['display_order' => $requestData['display_order']]);
        }
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
