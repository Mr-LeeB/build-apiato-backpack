<div class="dropdown">
    <button class="btn btn-light-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu px-1" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item btn btn-primary mb-1 d-flex justify-content-center"
            href="{!! url($crud->route) . '/' . $entry->getKey() . '/show' !!}">Show</a>
        <a class="dropdown-item btn btn-success mb-1 d-flex justify-content-center"
            href="{!! url($crud->route) . '/' . $entry->getKey() . '/edit' !!}">Edit</a>
        <a class="dropdown-item btn btn-danger d-flex justify-content-center" data-kt-docs-table-filter="delete_row"
            data-id="{{ $entry->getKey() }}" data-name="{{ $entry->name ?? $entry->getKey() }}">Delete</a>
    </div>
</div>
