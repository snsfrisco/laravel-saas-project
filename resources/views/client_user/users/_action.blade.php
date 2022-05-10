    @can('Edit User')
    <a href="{{route('client_user.users.edit',$user['id'])}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Edit User">
        <i class="fa fa-edit"></i>
    </a>
    @endcan

    @can('Delete User')
    <form method="POST" action="{{route('client_user.users.destroy',$user['id'])}}"  class="d-inline">
	@csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_user" data-toggle="tooltip" data-placement="left" title="Delete User">
            <i class="fa fa-trash"></i>
        </button>
    </form>
    @endcan
