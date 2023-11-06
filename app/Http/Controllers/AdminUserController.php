<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $records = User::query()->paginate(25);
        return view('admin_users.index', compact('records'));
    }

    public function add()
    {
        $roles = Role::query()->get();
        $formMode = "Add";
        return view('admin_users.form', compact('roles', 'formMode'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::query()->get();
        $formMode = "Edit";
        return view('admin_users.form', compact('roles', 'user', 'formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
        ];
        if ($request->filled('update_id')) {
            $validateArr['email'] .= ',' . $request->filled('update_id') . ',id';
        }
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        if (isset($requestData['update_id'])) {
            $item = User::where('id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            User::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('admin_users.index')->with('success', $message);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = User::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('admin_users.index')->with('success', 'Data Deleted Successfully');
    }
}
