@if($item->user_id != 1)
    @if($user->can('admin-user-write'))
        <a href="{{ route('admin_users.edit', $item->user_id) }}"
           class="btn btn-icon btn-primary waves-effect waves-float waves-light">
            <i data-feather="edit-2"></i>
        </a>
    @endif
    @if($user->can('admin-user-delete'))
        <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
           onclick="confirmDelete('deleteForm{{ $item->user_id }}')">
            <i data-feather="trash"></i>
        </a>
        <form method="POST" id="deleteForm{{ $item->user_id }}"
              action="{{ route('admin_users.delete', $item->user_id) }}">
            {{ method_field('DELETE') }}
            @csrf
        </form>
    @endif
@else
    ---
@endif