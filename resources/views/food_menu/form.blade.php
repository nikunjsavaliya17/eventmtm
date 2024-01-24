@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Menu</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('food_menu.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['food_menu.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($foodMenu))
                    <input type="hidden" name="update_id" value="{{ $foodMenu->food_menu_id }}">
                @endif
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Food Partner</label>
                    {!! Form::select('food_partner_id', $foodPartners, $foodMenu->food_partner_id ?? old('food_partner_id'), ['class' => 'form-control select2', 'placeholder' => 'Select', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Food Type</label>
                    {!! Form::select('food_type_id', $foodTypes, $foodMenu->food_type_id ?? old('food_type_id'), ['class' => 'form-control select2', 'placeholder' => 'Select', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Title</label>
                    {!! Form::text('title', $foodMenu->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => true]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">SKU</label>
                    {!! Form::number('sku', $foodMenu->sku ?? old('sku'), ['class' => 'form-control', 'placeholder' => 'Enter quantity', 'required' => true, 'min'=>0]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Amount</label>
                    {!! Form::number('amount', $foodMenu->amount ?? old('amount'), ['class' => 'form-control', 'placeholder' => 'Enter amount', 'required' => true, 'min'=>1]) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Image</label>
                    <input type="file" accept="image/*" class="dropifyImage"
                           data-allowed-file-extensions="png jpg jpeg" data-show-remove="false"
                           @if (isset($foodMenu) && $foodMenu->image != '') data-default-file="{{ getFileUrl($foodMenu->image, \App\Models\FoodMenu::IMG_DIR) }}"
                           @else required
                           @endif
                           name="image" id="image">
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Ingredients</label>
                    <textarea name="ingredients" id="ingredients" class="form-control" rows="3"
                              placeholder="Enter details..">{{ $foodMenu->ingredients ?? old('ingredients') }}</textarea>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Other Details</label>
                    <textarea name="other_details" id="other_details" class="form-control" rows="3"
                              placeholder="Enter details..">{{ $foodMenu->other_details ?? old('other_details') }}</textarea>
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
            $('.dropifyImage').dropify();
        })
    </script>
@endpush
