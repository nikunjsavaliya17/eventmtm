<?php

namespace App\Http\Middleware;

use App\Models\AppUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ValidateUserAccessToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if ($token) {
            $token = explode(' ', $token);
            if (@$token[1]) {
                $token = $token[1];
            }
            $user = AppUser::select('app_user_id')->where('access_token', $token)->first();
            if (isset($user)){
                $request['set_app_user_id'] = $user->app_user_id;
                return $next($request);
            }
        }
        return response()->json([
            'status' => false,
            'message' => "Invalid user access token!",
            'data' => [],
        ], 401);
    }
}
