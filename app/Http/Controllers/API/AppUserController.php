<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;
use App\Models\AppUser;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = AppUser::find($request->get('set_app_user_id'));
        return response()->json(['status' => true, 'message' => 'Success', 'data' => new AppUserResource($user)], 200);
    }

    public function updateProfile(Request $request): \Illuminate\Http\JsonResponse
    {
        $updateData = [];
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
            AppUser::where('set_app_user_id', $request->get('set_app_user_id'))->update($updateData);
        }
        return response()->json(['status' => true, 'message' => 'Success', 'data' => []], 200);
    }
}
