<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsor;
use App\Models\SponsorType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SponsorController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = Sponsor::query()->with(['createdByUser:user_id,name', 'typeDetail:sponsor_type_id,title', 'eventDetail:event_id,title']);
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('sponsor-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch' . $item->sponsor_id . '"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus(' . $item->sponsor_id . ')" name="is_active_' . $item->sponsor_id . '" type="checkbox" ' . $checkedClass . ' class="form-check-input" id="customSwitch' . $item->sponsor_id . '" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->editColumn('sponsor_type_id', function ($item) {
                    return $item->typeDetail->title ?? "---";
                })
                ->editColumn('event_id', function ($item) {
                    return $item->eventDetail->title ?? "---";
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->editColumn('created_by', function ($item) {
                    return $item->createdByUser->name ?? "---";
                })
                ->addColumn('actions', function ($item) use ($user) {
                    return view('sponsors.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('sponsors.index', compact('user'));
    }

    public function add()
    {
        $formMode = 'Add';
        $sponsorTypes = SponsorType::pluck('title', 'sponsor_type_id')->toArray();
        $events = Event::pluck('title', 'event_id')->toArray();
        return view('sponsors.form', compact('formMode', 'sponsorTypes', 'events'));
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
            $validateArr['company_name'] .= ',' . $request->get('update_id') . ',sponsor_id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        if (isset($requestData['logo'])) {
            $requestData['logo'] = uploadFile($requestData['logo'], Sponsor::IMG_DIR);
        }
        if (isset($requestData['update_id'])) {
            $item = Sponsor::where('sponsor_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['created_by'] = auth()->user()->user_id;
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
        $events = Event::pluck('title', 'event_id')->toArray();
        return view('sponsors.form', compact('formMode', 'sponsor', 'sponsorTypes', 'events'));
    }

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Sponsor::findOrFail($requestData['pk']);
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
        $record = Sponsor::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('sponsors.index')->with('success', 'Data Deleted Successfully');
    }
}
