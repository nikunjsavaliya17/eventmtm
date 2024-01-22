@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Edit Page</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('custom_page.index') }}" class="dt-button create-new btn btn-warning" tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['custom_page.update', $page->page_id], 'id' => 'inputForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Title</label>
                    {!! Form::text('title', $page->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title']) !!}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="form-label">Identifier</label>
                    {!! Form::text('identifier', $page->identifier ?? old('identifier'), ['class' => 'form-control', 'placeholder' => 'Enter identifier', 'disabled']) !!}
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    {!! Form::textarea('content', $page->content ?? old('content'), ['class' => 'form-control html_editor', 'placeholder' => 'Enter content']) !!}
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
        $(document).ready(function (){
            $("#inputForm").validate({
                ignore: '.note-editable',
                rules: {
                    'title': {
                        required: true,
                    },
                    'content': {
                        required: true,
                    },
                }
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
