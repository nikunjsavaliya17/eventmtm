@if($user->can('sponsor-type-write'))
    <a href="{{ route('sponsor_types.edit', $item->sponsor_type_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('sponsor-type-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->sponsor_type_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->sponsor_type_id }}"
          action="{{ route('sponsor_types.delete', $item->sponsor_type_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif