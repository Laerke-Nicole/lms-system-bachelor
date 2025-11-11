@props(['showRoute', 'editRoute', 'deleteRoute'])

<form action="{{ $deleteRoute }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')

    <div class="dropdown">
        <button class="btn mb-0 p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical fs-4"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item fs-5" href="{{ $showRoute }}"><i class="bi bi-eye me-2"></i>View</a></li>
            <li><a class="dropdown-item fs-5" href="{{ $editRoute }}"><i class="bi bi-pencil-square me-2"></i>Edit</a></li>
            <li><button type="submit" class="mb-0 dropdown-item fs-5" onclick="return confirm('Delete this item?')"><i class="bi bi-trash3 me-2"></i>Delete</button></li>
        </ul>
    </div>
</form>
