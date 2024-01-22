@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">{{ $formMode }} Faq</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('faqs.index') }}" class="dt-button create-new btn btn-warning"
                       tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['faqs.store_update'], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                @if(isset($faq))
                    <input type="hidden" name="update_id" value="{{ $faq->faq_id }}">
                @endif
                <div class="col-sm-12">
                    <label class="form-label">Question</label>
                    {!! Form::text('question', $faq->question ?? old('question'), ['class' => 'form-control', 'placeholder' => 'Enter question', 'required' => true]) !!}
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    {!! Form::textarea('answer', $faq->answer ?? old('answer'), ['class' => 'form-control html_editor', 'placeholder' => 'Enter answer']) !!}
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css"/>
@endpush
@push('footer_scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#inputForm").validate({
                ignore: '.note-editable',
            });

            $('.html_editor').summernote({
                tabsize: 4,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['codeview']]
                ]
            });
        })
    </script>
@endpush
