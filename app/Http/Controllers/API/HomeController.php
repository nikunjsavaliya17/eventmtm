<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\FoodMenuResource;
use App\Http\Resources\FoodPartnerResource;
use App\Models\Event;
use App\Models\EventCompany;
use App\Models\EventMedia;
use App\Models\FoodMenu;
use App\Models\FoodPartner;
use App\Models\Sponsor;
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
        ]]);
    }

    public function eventDetail(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'event_id' => 'required|numeric',
        ]);
        $event = Event::byActive()->with(['sponsors', 'relatedMedia', 'eventFoodPartners.foodPartnerDetail' => function ($q){
            $q->byActive();
        }])->where('event_id', $request->get('event_id'))->first();
        if (isset($event)) {
            $eventData = [
                'event_id' => $event->event_id,
                'title' => $event->title,
                'description' => $event->description,
                'image' => getFileUrl($event->image, Event::IMG_DIR),
                'address' => $event->address,
                'event_date' => formatDate($event->start_date, 'd-m-Y'),
                'event_start_time' => formatDate($event->start_date, 'h:i:s'),
                'event_end_time' => formatDate($event->end_date, 'h:i:s'),
                'event_performance' => [],
                'event_gallery' => [],
                'event_gold_sponsors' => [],
                'event_power_by' => [
                    [
                        "user_image" => getFileUrl($event->eventCompanyDetail->image, EventCompany::IMG_DIR),
                        "user_name" => $event->eventCompanyDetail->title
                    ]
                ],
                'food_partners' => [],
            ];
            foreach ($event->sponsors as $sponsor) {
                $eventData['event_gold_sponsors'][] = [
                    "user_image" => getFileUrl($sponsor->logo, Sponsor::IMG_DIR),
                    "user_name" => $sponsor->company_name
                ];
            }
            foreach ($event->relatedMedia as $relatedMedia) {
                $eventData['event_gallery'][] = [
                    'url' => getFileUrl($relatedMedia->media_value, EventMedia::MEDIA_DIR),
                    'isVideo' => ($relatedMedia->media_type == 2),
                ];
            }
            foreach ($event->eventFoodPartners as $eventFoodPartner) {
                $eventData['food_partners'][] = [
                    'company_name' => $eventFoodPartner->foodPartnerDetail->company_name,
                    'logo' => getFileUrl($eventFoodPartner->foodPartnerDetail->logo, FoodPartner::IMG_DIR),
                ];
            }
            return response()->json(['status' => true, 'message' => 'Success', 'data' => $eventData]);
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid event', 'data' => []]);
        }
    }

    public function restaurants(Request $request)
    {
        $this->validateAPIRequest($request, [
            'event_id' => 'required|numeric',
        ]);
        $event_id = $request->get('event_id');
        $event = Event::byActive()->where('event_id', $request->get('event_id'))->first();
        if (!empty($event)){
            $foodPartners = FoodPartner::byActive()->whereHas('relatedEvents', function ($q) use ($event_id){
               $q->where('event_id', $event_id);
            })->simplePaginate();
            return response()->json(['status' => true, 'message' => 'Success', 'data' => FoodPartnerResource::collection($foodPartners)]);
        }else{
            return response()->json(['status' => false, 'message' => 'Invalid event', 'data' => []]);
        }
    }

    public function menuList(Request $request)
    {
        $this->validateAPIRequest($request, [
            'food_partner_id' => 'required|numeric',
        ]);
        $food_partner_id = $request->get('food_partner_id');
        $records = FoodMenu::byActive()->with(['foodPartnerDetail'])->where('food_partner_id', $food_partner_id)->simplePaginate();
        return response()->json(['status' => true, 'message' => 'Success', 'data' => FoodMenuResource::collection($records)]);
    }
}
