
    @can('edit_role')
    <a href="{{route($route_prefix.'edit',$role['id'])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-edit"></i>
    </a>
    @endcan

    @if ( ! in_array($role->id, [1,2,3]) )
        @can('delete_role')
        <form method="POST" action="{{route($route_prefix.'destroy',$role['id'])}}" class="d-inline">
            @csrf
            <input type="hidden" name="_method" value="delete">
            <button type="submit" class="btn btn-danger btn-sm delete_role">
                <i class="fa fa-trash"></i>
            </button>
        </form>
        @endcan
    @endif
