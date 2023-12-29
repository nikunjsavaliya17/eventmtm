<?php

namespace App\Http\Controllers;

use App\Models\SponsorType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SponsorTypeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = SponsorType::query()->with(['createdByUser:user_id,name']);
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('sponsor-type-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch' . $item->sponsor_type_id . '"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus(' . $item->sponsor_type_id . ')" name="is_active_' . $item->sponsor_type_id . '" type="checkbox" ' . $checkedClass . ' class="form-check-input" id="customSwitch' . $item->sponsor_type_id . '" />
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
                    return view('sponsor_types.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('sponsor_types.index', compact('user'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('sponsor_types.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required|unique:sponsor_types,title',
        ];
        if ($request->filled('update_id')) {
            $validateArr['title'] .= ',' . $request->filled('update_id') . ',sponsor_type_id';
        }
        $requestData = $request->except('_token');
        if (isset($requestData['update_id'])) {
            $item = SponsorType::where('sponsor_type_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['created_by'] = auth()->user()->user_id;
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

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = SponsorType::findOrFail($requestData['pk']);
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
        $record = SponsorType::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('sponsor_types.index')->with('success', 'Data Deleted Successfully');
    }
}
