<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCompany;
use App\Models\FoodPartner;
use App\Models\FoodType;
use App\Models\SponsorType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function validateAPIRequest(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);
        if ($validator->fails()) {
            $error = array_values($validator->errors()->toArray());
            response()->json(['status' => false, 'message' => $error[0][0], 'data' => []])->throwResponse();
        }
    }

    public function getSponsorTypeArr(): array
    {
        $user = auth()->user();
        $records = SponsorType::query();
        if (!$user->hasRole(config('constants.ROLES.SUPER_ADMIN'))) {
            $records->where('created_by', $user->user_id);
        }
        return $records->pluck('title', 'sponsor_type_id')->toArray();
    }

    public function getEventArr(): array
    {
        $user = auth()->user();
        $records = Event::query();
        if (!$user->hasRole(config('constants.ROLES.SUPER_ADMIN'))) {
            $records->where('created_by', $user->user_id);
        }
        return $records->pluck('title', 'event_id')->toArray();
    }

    public function getEventCompanyArr(): array
    {
        $user = auth()->user();
        $records = EventCompany::query();
        if (!$user->hasRole(config('constants.ROLES.SUPER_ADMIN'))) {
            $records->where('created_by', $user->user_id);
        }
        return $records->pluck('title', 'event_company_id')->toArray();
    }

    public function getFoodTypeArr(): array
    {
        $user = auth()->user();
        $records = FoodType::query();
        if (!$user->hasRole(config('constants.ROLES.SUPER_ADMIN'))) {
            $records->where('created_by', $user->user_id);
        }
        return $records->pluck('title', 'food_type_id')->toArray();
    }

    public function getFoodPartnerArr(): array
    {
        $user = auth()->user();
        $records = FoodPartner::query();
        if (!$user->hasRole(config('constants.ROLES.SUPER_ADMIN'))) {
            $records->where('created_by', $user->user_id);
        }
        return $records->pluck('company_name', 'food_partner_id')->toArray();
    }
}
