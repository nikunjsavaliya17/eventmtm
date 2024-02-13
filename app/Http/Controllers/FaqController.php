<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = Faq::query();
            return DataTables::of($data)
                ->editColumn('is_active', function ($item) use ($user) {
                    if ($user->can('faqs-write')) {
                        $checkedClass = $item->is_active ? 'checked' : '';
                        $is_publish = '<div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="customSwitch'.$item->faq_id.'"></label>
                                            <div class="form-check form-check-primary form-switch">
                                                <input onClick="javascript:updatePublishStatus('.$item->faq_id.')" name="is_active_'.$item->faq_id.'" type="checkbox" '.$checkedClass.' class="form-check-input" id="customSwitch'.$item->faq_id.'" />
                                            </div>
                                        </div>';
                    } else {
                        $value = $item->is_active ? 'Yes' : 'No';
                        $class = $item->is_active ? 'success' : 'danger';
                        $is_publish = '<div class="badge badge-light-' . $class . '">' . $value . '</div>';
                    }
                    return $is_publish;
                })
                ->editColumn('created_at', function ($item) {
                    return formatDate($item->created_at);
                })
                ->addColumn('actions', function ($item) use ($user) {
                    return view('faqs.partials.actions', compact('item', 'user'));
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }
        return view('faqs.index', compact('user'));
    }

    public function add()
    {
        $formMode = 'Add';
        return view('faqs.form', compact('formMode'));
    }

    public function store_update(Request $request)
    {
        $validateArr = [
            'question' => 'required',
            'answer' => 'required',
        ];
        $this->validate($request, $validateArr);
        $requestData = $request->except('_token');
        if (isset($requestData['update_id'])) {
            $item = Faq::where('faq_id', $requestData['update_id'])->first();
            unset($requestData['update_id']);
            $item->update($requestData);
            $message = "Data Updated Successfully";
        } else {
            Faq::create($requestData);
            $message = "Data Created Successfully";
        }
        return redirect()->route('faqs.index')->with('success', $message);
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $formMode = 'Edit';
        return view('faqs.form', compact('formMode', 'faq'));
    }

    public function update_data(Request $request)
    {
        $requestData = $request->except('_token');
        $record = Faq::findOrFail($requestData['pk']);
        if ($request->get('name') == 'is_active'){
            $record->update(['is_active' => ($record->is_active == 1) ? 0 : 1]);
        }else{
            $record->update(['display_order' => $requestData['display_order']]);
        }
        return response()->json(['status' => true]);
    }

    public function delete($record_id)
    {
        Faq::destroy($record_id);
        return redirect()->route('faqs.index')->with('success', 'Data Deleted Successfully');
    }
}
