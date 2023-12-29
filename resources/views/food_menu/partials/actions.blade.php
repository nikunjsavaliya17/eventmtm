@if($user->can('food-menu-write'))
    <a href="{{ route('food_menu.edit', $item->food_menu_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('food-menu-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->food_menu_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->food_menu_id }}"
          action="{{ route('food_menu.delete', $item->food_menu_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif