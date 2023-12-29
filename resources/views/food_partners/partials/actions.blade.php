@if($user->can('food-partner-write'))
    <a href="{{ route('food_partners.edit', $item->food_partner_id) }}"
       class="btn btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather="edit-2"></i>
    </a>
@endif
@if($user->can('food-partner-delete'))
    <a href="javascript:;" class="btn btn-icon btn-danger waves-effect waves-float waves-light"
       onclick="confirmDelete('deleteForm{{ $item->food_partner_id }}')">
        <i data-feather="trash"></i>
    </a>
    <form method="POST" id="deleteForm{{ $item->food_partner_id }}"
          action="{{ route('food_partners.delete', $item->food_partner_id) }}">
        {{ method_field('DELETE') }}
        @csrf
    </form>
@endif