<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function orders(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->ajax()) {
            $data = Order::query()->with(['eventDetail:event_id,title', 'appUserDetail']);
            return DataTables::of($data)
                ->addColumn('event_title', function ($item) {
                    return $item->eventDetail->title ?? "---";
                })
                ->addColumn('user_name', function ($item) {
                    return $item->appUserDetail->first_name.' '.$item->appUserDetail->last_name;
                })
                ->editColumn('total_amount', function ($item) {
                    return formatAmount($item->total_amount);
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('reports.orders.index');
    }

    public function appUsers(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = AppUser::query();
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('app-users-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch'.$item->app_user_id.'"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updateActiveStatus('.$item->app_user_id.')" name="is_active_'.$item->app_user_id.'" type="checkbox" '.$checkedClass.' class="form-check-input" id="customSwitch'.$item->app_user_id.'" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->addColumn('name', function ($item) {
                    return $item->first_name.' '.$item->last_name;
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('reports.app_users.index');
    }

    public function updateAppUserStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $requestData = $request->except('_token');
        $record = AppUser::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active'){
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        }
        return response()->json(['status' => true]);
    }
}
