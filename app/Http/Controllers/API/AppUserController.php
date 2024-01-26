<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;
use App\Http\Resources\OrderResource;
use App\Models\AppUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppUserController extends Controller
{
    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = AppUser::find($request->get('set_app_user_id'));
        return response()->json(['status' => true, 'message' => 'Success', 'data' => new AppUserResource($user)]);
    }

    public function updateProfile(Request $request): \Illuminate\Http\JsonResponse
    {
        $updateData = [];
        if ($request->filled('first_name')) {
            $updateData['first_name'] = $request->get('first_name');
        }
        if ($request->filled('last_name')) {
            $updateData['last_name'] = $request->get('last_name');
        }
        if ($request->filled('email')) {
            $updateData['email'] = $request->get('email');
        }
        if ($request->filled('mobile_number')) {
            $updateData['mobile_number'] = $request->get('mobile_number');
        }
        if ($request->filled('device_id')) {
            $updateData['device_id'] = $request->get('device_id');
        }
        if ($request->filled('address')) {
            $updateData['address'] = $request->get('address');
        }
        if ($request->filled('latitude')) {
            $updateData['latitude'] = $request->get('latitude');
        }
        if ($request->filled('longitude')) {
            $updateData['longitude'] = $request->get('longitude');
        }
        if ($request->filled('fcm_token')) {
            $updateData['fcm_token'] = $request->get('fcm_token');
        }
        if (!empty($updateData)) {
            AppUser::where('app_user_id', $request->get('set_app_user_id'))->update($updateData);
        }
        return response()->json(['status' => true, 'message' => 'Success', 'data' => []]);
    }

    public function updatePassword(Request $request)
    {
        $this->validateAPIRequest($request, [
            'old_password' => 'required|min:4',
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:4'
        ]);
        $requestData = $request->all();
        $user = AppUser::where('app_user_id', $request->get('set_app_user_id'))->first();
        if (Hash::check($requestData['old_password'], $user->password)) {
            $user->update(['password' => Hash::make($requestData['password'])]);
            return response()->json(['status' => true, 'message' => 'Success', 'data' => []]);
        } else {
            return response()->json(['status' => false, 'message' => 'Incorrect old password.', 'data' => []]);
        }
    }

    public function orderList(Request $request): \Illuminate\Http\JsonResponse
    {
        $orders = Order::with(['eventDetail', 'appUserDetail'])->where('app_user_id', $request->get('set_app_user_id'))->orderBy('order_id', 'DESC')->simplePaginate();
        return response()->json(['status' => true, 'message' => 'Success', 'data' => OrderResource::collection($orders)]);
    }

    public function orderDetail(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'order_id' => 'required',
        ]);
        $order = Order::with(['eventDetail', 'appUserDetail', 'orderItems'])
            ->where('app_user_id', $request->get('set_app_user_id'))
            ->where('order_id', $request->get('order_id'))->first();
        return response()->json(['status' => true, 'message' => 'Success', 'data' => new OrderResource($order)]);
    }

    public function cancelOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'order_id' => 'required',
        ]);
        $order = Order::where('app_user_id', $request->get('set_app_user_id'))
            ->where('order_id', $request->get('order_id'))->where('status', 0)->first();
        if (!empty($order)) {
            $order->update(['status' => 2]);
            return response()->json(['status' => true, 'message' => 'Success', 'data' => []]);
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid order', 'data' => []]);
        }
    }
}
