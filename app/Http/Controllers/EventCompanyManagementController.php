<?php

namespace App\Http\Controllers;

use App\Models\EventCompany;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EventCompanyManagementController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = EventCompany::query()->with(['createdByUser:user_id,name']);
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('event-company-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch' . $item->event_company_id . '"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus(' . $item->event_company_id . ')" name="is_active_' . $item->event_company_id . '" type="checkbox" ' . $checkedClass . ' class="form-check-input" id="customSwitch' . $item->event_company_id . '" />
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
                    return view('event_company_management.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('event_company_management.index', compact('user'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('event_company_management.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required|unique:event_companies,title',
            'address' => 'required',
            'email' => 'email|required|unique:event_companies,email',
            'phone_number' => 'required|numeric|digits:10',
            'contact_name' => 'required',
            'contact_email' => 'email|required',
            'contact_phone_number' => 'required|numeric|digits:10',
            'username' => 'required|unique:event_companies,username',
        ];
        if ($request->filled('update_id')) {
            $validateArr['title'] .= ',' . $request->get('update_id') . ',event_company_id';
            $validateArr['email'] .= ',' . $request->get('update_id') . ',event_company_id';
            $validateArr['username'] .= ',' . $request->get('update_id') . ',event_company_id';
        } else {
            $validateArr['password'] = 'required';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        } else {
            unset($requestData['password']);
        }
        if (isset($requestData['update_id'])) {
            $item = EventCompany::where('event_company_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            if (isset($requestData['image'])) {
                $requestData['image'] = uploadFile($requestData['image'], EventCompany::IMG_DIR, $item->image);
            }
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['created_by'] = auth()->user()->user_id;
            $requestData['image'] = uploadFile($requestData['image'], EventCompany::IMG_DIR);
            EventCompany::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('event_company_management.index')->with('success', $message);
    }

    public function edit($id)
    {
        $eventCompany = EventCompany::findOrFail($id);
        $formMode = 'Edit';
        return view('event_company_management.form', compact('eventCompany', 'formMode'));
    }

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = EventCompany::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active') {
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        }
        return response()->json(['status' => true]);
    }

    public function delete($record_id)
    {
        EventCompany::destroy($record_id);
        return redirect()->route('event_company_management.index')->with('success', 'Data Deleted Successfully');
    }
}
