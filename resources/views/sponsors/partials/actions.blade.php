@if($user->can('sponsor-write'))
    <a href="{{ route('sponsors.edit', $item->sponsor_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('sponsor-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->sponsor_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->sponsor_id }}"
          action="{{ route('sponsors.delete', $item->sponsor_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif