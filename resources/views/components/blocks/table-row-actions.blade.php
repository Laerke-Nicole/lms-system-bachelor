@props(['showRoute', 'editRoute', 'deleteRoute'])

<form action="{{ $deleteRoute }}" method="POST" class="d-inline">
    <a class="btn btn-info btn-sm" href="{{ $showRoute }}"><i class="bi bi-eye"></i></a>
    <a class="btn btn-primary btn-sm" href="{{ $editRoute }}"><i class="bi bi-pencil-square"></i></a>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this item?')"><i class="bi bi-trash3"></i></button>
</form>
