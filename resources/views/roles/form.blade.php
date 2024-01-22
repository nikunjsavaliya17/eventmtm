@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Edit Permissions - {{ $role->name }}</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('roles.index') }}" class="dt-button create-new btn btn-warning" tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['roles.update', $role->id], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @foreach($permissions as $permission)
                    <div class="col-md-4 col-sm-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox_{{ $permission->id }}" name="permissions[{{ $permission->id }}]" value="{{ $permission->id }}" @if(in_array($permission->id, $current_permissions)) checked @endif>
                            <label class="form-check-label" for="inlineCheckbox_{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('footer_scripts')

@endpush
