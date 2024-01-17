<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCompany;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class EventManagementController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = Event::query()->with(['createdByUser:user_id,name', 'eventCompanyDetail:event_company_id,title']);
            if ($request->filled('created_by')) {
                $data = $data->where('created_by', $request->get('created_by'));
            }
            if ($request->filled('is_active')) {
                $data = $data->where('is_active', $request->get('is_active'));
            }
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('event-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch' . $item->event_id . '"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus(' . $item->event_id . ')" name="is_active_' . $item->event_id . '" type="checkbox" ' . $checkedClass . ' class="form-check-input" id="customSwitch' . $item->event_id . '" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->addColumn('event_company', function ($item) {
                    return $item->eventCompanyDetail->title ?? "---";
                })
                ->editColumn('start_date', function ($item) {
                    return formatDate($item->start_date);
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->editColumn('created_by', function ($item) {
                    return $item->createdByUser->name ?? "---";
                })
                ->addColumn('actions', function ($item) use ($user) {
                    return view('event_management.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('event_management.index', compact('user'));
    }

    public function add()
    {
        $formMode = 'Add';
        $companies = EventCompany::pluck('title', 'event_company_id')->toArray();
        return view('event_management.form', compact('formMode', 'companies'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'title' => 'required',
            'contact_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'contact_email' => 'email|required',
            'contact_phone_number' => 'required|numeric|digits:10',
        ];
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');

        if (isset($requestData['update_id'])) {
            $event = Event::where('event_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            if (isset($requestData['image'])) {
                $requestData['image'] = uploadFile($requestData['image'], Event::IMG_DIR, $event->image);
            }
            $event->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            $requestData['is_active'] = 1;
            $requestData['image'] = uploadFile($requestData['image'], Event::IMG_DIR);
            $requestData['created_by'] = auth()->user()->user_id;
            $event = Event::create($requestData);
            $message = "Data Created Successfully";
        }

        $media_dir = EventMedia::MEDIA_DIR;
        $event_media_ids = [];
        if (isset($requestData['media_list']) && !empty($requestData['media_list'])){
            foreach ($requestData['media_list'] as $datum){
                if (isset($datum['exist_id']) && !empty($datum['exist_id'])){
                    $event_media_ids[] = $datum['exist_id'];
                    if (isset($datum['media'])){
                        $eventMediaData = EventMedia::find($datum['exist_id']);
                        $event_media_name = uploadFile($datum['media'], $media_dir, $eventMediaData->media_value);
                        $eventMediaData->update([
                            'media_type' => Str::contains($event_media_name, '.mp4') ? 2 : 1,
                            'media_value' => $event_media_name,
                            'created_by' => auth()->user()->user_id,
                        ]);
                    }
                }else{
                    $event_media_name = uploadFile($datum['media'], $media_dir);
                    $eventMediaData = EventMedia::create([
                        'event_id' => $event->event_id,
                        'media_type' => Str::contains($event_media_name, '.mp4') ? 2 : 1,
                        'media_value' => $event_media_name,
                        'created_by' => auth()->user()->user_id,
                    ]);
                    $event_media_ids[] = $eventMediaData->event_media_id;
                }
            }
        }
        $deletedMediaList = EventMedia::where('event_id', $event->event_id)->whereNotIn('event_media_id', $event_media_ids)->get();
        foreach ($deletedMediaList as $deletedMedia){
            removeFile($deletedMedia->media_value, $media_dir);
            $deletedMedia->delete();
        }
        return redirect()->route('event_management.index')->with('success', $message);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $formMode = 'Edit';
        $companies = EventCompany::pluck('title', 'event_company_id')->toArray();
        return view('event_management.form', compact('event', 'formMode', 'companies'));
    }

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Event::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active'){
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        }
        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Event::findOrFail($requestData['record_id']);
        $record->delete();
        return redirect()->route('event_management.index')->with('success', 'Data Deleted Successfully');
    }
}
