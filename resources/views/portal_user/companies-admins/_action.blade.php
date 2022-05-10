    @can('edit_company_admin')
    <a href="{{route('portal_user.companies-admins.edit',$company_user->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Edit Company">
        <i class="fa fa-edit"></i>
    </a>
    @endcan

    @can('delete_company_admin')
    <form method="POST" action="{{route('portal_user.companies-admins.destroy',$company_user->id)}}"  class="d-inline">
	@csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-danger btn-sm delete_user" data-toggle="tooltip" data-placement="left" title="Delete Company">
            <i class="fa fa-trash"></i>
        </button>
    </form>
    @endcan
