<div class="dropdown">
    <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i
                class="la la-ellipsis-h"></i></a>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        @if(Route::has($route . '.show'))

            <li><a class="dropdown-item" href="{{ route($route . '.show', ['id' => $id]) }}"><i class="la la-eye"></i>
                    View</a></li>
        @endif
        @if(Route::has($route . '.edit'))

            <li><a class="dropdown-item" href="{{ route($route . '.edit', ['id' => $id]) }}"><i class="la la-edit"></i>
                    Edit</a></li>
        @endif
        @if(Route::has($route . '.destroy'))

            <li><a class="dropdown-item deleteAction" href="#" data-id="#delete-form-{{ $id }}" data-toggle="modal"
                   data-target="#delete-form-modal"><i class="la la-trash"></i> Delete</a></li>
        @endif
    </ul>

</div>
@if(Route::has($route . '.destroy'))

    <form id="delete-form-{{ $id }}" action="{{ route($route . '.destroy', ['id' => $id]) }}" method="POST"
          style="display: none;">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>
@endif