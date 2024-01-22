@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h4 class="card-title">Edit Email Template -
                ({{ \App\Models\EmailTemplate::IDENTIFIERS[$email_template->identifier] }})</h4>
            <div class="dt-action-buttons text-end">
                <div class="dt-buttons d-inline-flex">
                    <a href="{{ route('email_templates.index') }}" class="dt-button create-new btn btn-warning" tabindex="0"
                       aria-controls="DataTables_Table_0"
                       type="button"><span><i data-feather="arrow-left"></i> Back</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body mt-1">
            {!! Form::open(['route' => ['email_templates.update', $email_template->id], 'id' => 'emailTemplateForm', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
            <div class="row g-1 mb-1">
                <div class="col-md-6 col-sm-12 position-relative">
                    <label class="form-label" for="title">Subject</label>
                    {!! Form::text('subject', $email_template->subject ?? old('subject'), ['class' => 'form-control', 'placeholder' => 'Enter subject']) !!}
                </div>
                <div class="col-md-6 col-sm-12 position-relative">
                    <label class="form-label" for="title">Email Variables</label>
                    <table class="table table-responsive d">
                        <thead>
                        <tr>
                            <th>Variable</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        @foreach(config('emailvariables')[$email_template->identifier] as $variable => $value)
                            <tbody>
                            <tr>
                                <td>#{{ $variable }}#</td>
                                <td>{{ $value }}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="col-12">
                    <label class="form-label" for="title">Content</label>
                    {!! Form::textarea('content', $email_template->content ?? old('content'), ['class' => 'form-control html_editor', 'placeholder' => 'Enter content']) !!}
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
            $("#emailTemplateForm").validate({
                ignore: '.note-editable',
                rules: {
                    'subject': {
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
