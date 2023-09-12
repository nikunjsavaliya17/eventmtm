<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    @if(!empty($sub_title))
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $sub_title }}</a></li>
                    @endif
                    <li class="breadcrumb-item active">{{ $page_title }}</li>
                </ol>
            </div>
            <h4 class="page-title">{{ $page_title }}</h4>
        </div>
    </div>
</div>
<!-- end page title -->
