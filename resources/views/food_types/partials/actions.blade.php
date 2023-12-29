@if($user->can('food-type-write'))
    <a href="{{ route('food_types.edit', $item->food_type_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('food-type-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->food_type_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->food_type_id }}"
          action="{{ route('food_types.delete', $item->food_type_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif