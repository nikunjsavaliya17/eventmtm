@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Sponsor Type</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('sponsor_types.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['sponsor_types.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($sponsorType))
                    <input type="hidden" name="update_id" value="{{ $sponsorType->sponsor_type_id }}">
                @endif
                <div class="col-md-6 col-sm-12 position-relative">
                    <label class="form-label" for="title">Title</label>
                    {!! Form::text('title', $sponsorType->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => true]) !!}
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
        })
    </script>
@endpush
