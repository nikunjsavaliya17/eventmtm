<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class ValidateApiSecretKey
{
    public function handle($request, Closure $next)
    {
        if ($request->header('X-Api-Key') == 'T1QeMmAMNMFjdt1V3YcVuHeNoRPT9FdHwFnVQ') {
            return $next($request);
        }
        return response()->json([
            'status' => false,
            'message' => 'Invalid API Key',
            'data' => null
        ], 403);
    }
}
