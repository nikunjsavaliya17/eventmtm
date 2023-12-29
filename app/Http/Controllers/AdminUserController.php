<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = User::query()->with(['createdByUser:user_id,name']);
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('admin-user-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch' . $item->user_id . '"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus(' . $item->user_id . ')" name="is_active_' . $item->user_id . '" type="checkbox" ' . $checkedClass . ' class="form-check-input" id="customSwitch' . $item->user_id . '" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->addColumn('role', function ($item) {
                    $assign_role = "";
                    $assign_role_data = $item->getRoleNames();
                    if (count($assign_role_data) > 0) {
                        $assign_role = "<div class='badge badge-light-primary mr-1'>$assign_role_data[0]</div>";
                    }
                    return $assign_role;
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->editColumn('created_by', function ($item) {
                    return $item->createdByUser->name ?? "---";
                })
                ->addColumn('actions', function ($item) use ($user) {
                    return view('admin_users.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions', 'role'])
                ->make(true);
        }
        return view('admin_users.index', compact('user'));
    }

    public function add()
    {
        $roles = Role::query()->pluck('name', 'name')->toArray();
        $formMode = "Add";
        return view('admin_users.form', compact('roles', 'formMode'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::query()->pluck('name', 'name')->toArray();
        $formMode = "Edit";
        $assign_role = "";
        $assign_role_data = $user->getRoleNames();
        if (count($assign_role_data) > 0) {
            $assign_role = $assign_role_data[0];
        }
        return view('admin_users.form', compact('roles', 'user', 'formMode', 'assign_role'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
        ];
        if ($request->filled('update_id')) {
            $validateArr['email'] .= ',' . $request->get('update_id') . ',user_id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        } else {
            unset($requestData['password']);
        }
        if (isset($requestData['update_id'])) {
            $user = User::where('user_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $user->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['created_by'] = auth()->user()->user_id;
            $user = User::create($requestData);
            $message = "Data Created Successfully";
        }
        $user->assignRole($requestData['role']);
        return redirect()->route('admin_users.index')->with('success', $message);
    }

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = User::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active') {
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        }
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = User::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('admin_users.index')->with('success', 'Data Deleted Successfully');
    }
}
