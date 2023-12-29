<?php

namespace App\Http\Middleware;

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
            $user = User::select('id')->where('access_token', $token)->first();
            if (isset($user)){
                $request['user_id'] = $user['id'];
                return $next($request);
            }
        }
        return response()->json([
            'status' => false,
            'message' => "Invalid user access token!",
        ], 401);
    }
}
