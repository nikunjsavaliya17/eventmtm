<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function faqs(Request $request): \Illuminate\Http\JsonResponse
    {
        $faqs = Faq::byActive()->orderBy('display_order', 'DESC')->get();
        return response()->json(['status' => true, 'message' => 'Success', 'data' => FaqResource::collection($faqs)]);
    }

    public function pageDetail(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateAPIRequest($request, [
            'identifier' => 'required'
        ]);
        $page = Page::where('identifier', $request->get('identifier'))->first();
        if (isset($page)) {
            return response()->json(['status' => true, 'message' => 'Success', 'data' => [
                'title' => $page->title,
                'identifier' => $page->identifier,
                'content' => $page->content,
            ]]);
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid page', 'data' => []]);
        }
    }
}
