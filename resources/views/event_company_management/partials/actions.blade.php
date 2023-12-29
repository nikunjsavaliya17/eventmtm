@if($user->can('event-company-write'))
    <a href="{{ route('event_company_management.edit', $item->event_company_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('event-company-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->event_company_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->event_company_id }}"
          action="{{ route('event_company_management.delete', $item->event_company_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif