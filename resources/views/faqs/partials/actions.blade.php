@if($user->can('faqs-write'))
    <a href="{{ route('faqs.edit', $item->faq_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('faqs-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->faq_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->faq_id }}"
          action="{{ route('faqs.delete', $item->faq_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif