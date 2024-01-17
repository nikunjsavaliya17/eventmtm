<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request): \Illuminate\Http\JsonResponse
    {
        $now = Carbon::now();
        $upcoming_events = Event::byActive()->where('start_date', '>', $now)->orderBy('start_date', 'ASC')->get();
        $ongoing_events = Event::byActive()->where('start_date', '<=', $now)->orderBy('start_date', 'DESC')->get();
        return response()->json(['status' => true, 'message' => 'Success', 'data' => [
            'upcoming_events' => EventResource::collection($upcoming_events),
            'ongoing_events' => EventResource::collection($ongoing_events),
        ]], 200);
    }
}
