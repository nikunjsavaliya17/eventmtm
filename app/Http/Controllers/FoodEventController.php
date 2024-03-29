<?php

namespace App\Http\Controllers;

use App\Models\FoodPartnerEvent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FoodEventController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = FoodPartnerEvent::query()->with(['eventDetail:event_id,title', 'createdByUser:user_id,name', 'foodPartnerDetail:food_partner_id,company_name']);
            if ($request->filled('food_partner_id')) {
                $data = $data->where('food_partner_id', $request->get('food_partner_id'));
            }
            if (!$user->hasRole(config('constants.ROLES.SUPER_ADMIN'))){
                $data = $data->where('created_by', $user->user_id);
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
                ->addColumn('event_title', function ($item) {
                    return $item->eventDetail->title ?? "---";
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
        $foodPartners = $this->getFoodPartnerArr();
        $events = $this->getEventArr();
        return view('food_events.form', compact('formMode', 'foodPartners', 'events'));
    }

    public function store_update(Request $request)
    {
        $requestData = $request->except('_token');
        if (isset($requestData['update_id'])) {
            $item = FoodPartnerEvent::where('food_partner_event_id', $requestData['update_id'])->first();
            $dataExist = FoodPartnerEvent::where('food_partner_event_id', '!=', $item->food_partner_event_id)->where('event_id', $requestData['event_id'])->where('food_partner_id', $requestData['food_partner_id'])->exists();
            if ($dataExist){
                return redirect()->back()->with('error', 'Event food partner relation already exists.');
            }
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $dataExist = FoodPartnerEvent::where('event_id', $requestData['event_id'])->where('food_partner_id', $requestData['food_partner_id'])->exists();
            if ($dataExist){
                return redirect()->back()->with('error', 'Event food partner relation already exists.');
            }
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
        $foodPartners = $this->getFoodPartnerArr();
        $events = $this->getEventArr();
        return view('food_events.form', compact('formMode', 'foodEvent', 'foodPartners', 'events'));
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

    public function delete($record_id)
    {
        FoodPartnerEvent::destroy($record_id);
        return redirect()->route('food_events.index')->with('success', 'Data Deleted Successfully');
    }
}
