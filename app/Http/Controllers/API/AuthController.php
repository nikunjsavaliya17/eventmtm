<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:' . AppUser::class,
            'password' => 'required|min:4',
            'mobile_number' => 'required|numeric|min_digits:5|max_digits:10',
        ]);
        $requestData = $request->all();
        $user = AppUser::create([
            'first_name' => $requestData['first_name'],
            'last_name' => $requestData['last_name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'mobile_number' => $requestData['mobile_number'],
            'otp' => 1111,
//            'access_token' => Str::random(40) . time(),
            'is_active' => 0,
        ]);
        return response()->json(['status' => true, 'message' => 'Success', 'data' => new AppUserResource($user)], 200);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'email' => 'required|max:255|email',
            'password' => 'required|min:4',
        ]);
        $requestData = $request->all();
        if (Auth::guard('api')->attempt(['email' => $requestData['email'], "password" => $requestData['password']])) {
            $user = Auth::guard('api')->user();
            if ($user->is_active == 1) {
                $user->access_token = Str::random(40) . time();
                $user->save();
                return response()->json(['status' => true, 'message' => 'Success', 'data' => new AppUserResource($user)], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'You not activated your account.', 'data' => []], 500);
            }
        }
        return response()->json(['status' => false, 'message' => 'Invalid Credentials', 'data' => []], 500);
    }

    public function forgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'email' => 'required|max:255|email',
        ]);
        $requestData = $request->all();
        $user = AppUser::where('email', $requestData['email'])->first();
        if (isset($user)) {
            return response()->json(['status' => true, 'message' => 'Success', 'data' => ['app_user_id' => $user->app_user_id]], 200);
        }
        return response()->json(['status' => false, 'message' => 'Invalid User', 'data' => []], 500);
    }

    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'app_user_id' => 'required|numeric',
            'password' => 'required|min:4',
        ]);
        $requestData = $request->all();
        $user = AppUser::where('app_user_id', $requestData['app_user_id'])->first();
        if (isset($user)) {
            $user->update(['password' => Hash::make($requestData['password'])]);
            return response()->json(['status' => true, 'message' => 'Success', 'data' => []], 200);
        }
        return response()->json(['status' => false, 'message' => 'Invalid User', 'data' => []], 500);
    }

    public function verifyOtp(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'app_user_id' => 'required|numeric',
            'otp' => 'required|numeric|digits:4',
        ]);
        $requestData = $request->all();
        $user = AppUser::where('app_user_id', $requestData['app_user_id'])->first();
        if (isset($user)) {
            if ($user->otp == $requestData['otp']) {
                $user->update(['is_active' => 1, 'otp' => null]);
                return response()->json(['status' => true, 'message' => 'Success', 'data' => new AppUserResource($user)], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Invalid OTP', 'data' => []], 500);
            }
        }
        return response()->json(['status' => false, 'message' => 'Invalid User', 'data' => []], 500);
    }
}
