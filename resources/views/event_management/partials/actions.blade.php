@if($user->can('event-write'))
    <a href="{{ route('event_management.edit', $item->event_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('event-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->event_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->event_id }}"
          action="{{ route('event_management.delete', $item->event_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif