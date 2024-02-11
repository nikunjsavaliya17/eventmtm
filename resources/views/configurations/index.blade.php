@extends('layouts.master')
@push('css')
@endpush
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Configurations</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route' => ['configuration.update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
                                <div class="row">
                                    @foreach($configurations as $configuration)
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-3">
                                                    <label class="col-form-label">{{ $configuration->title }}</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control"
                                                           name="configurations[{{ $configuration->identifier }}]"
                                                           value="{{ $configuration->value }}"
                                                           placeholder="Enter {{ $configuration->title }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if(auth()->user()->can('configuration-write'))
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 waves-effect waves-float waves-light">
                                                Update
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate();
        });
    </script>
@endpush
