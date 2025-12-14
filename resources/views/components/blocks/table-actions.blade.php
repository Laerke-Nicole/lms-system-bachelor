@props(['showRoute' => null, 'editRoute' => null, 'deleteRoute' => null])

<form action="{{ $deleteRoute }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')

    <div class="dropdown">
        <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical fs-4"></i>
        </button>
        <ul class="dropdown-menu">
            @if($showRoute)
                <li><a class="dropdown-item fs-5" href="{{ $showRoute }}"><i class="bi bi-eye me-2"></i>View</a></li>
            @endif

            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'leader')
                @if($editRoute)
                    <li><a class="dropdown-item fs-5" href="{{ $editRoute }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                @endif

                @if($deleteRoute)
                    <li><button type="submit" class="dropdown-item fs-5" onclick="return confirm('Delete this item?')"><i class="bi bi-trash3 me-2"></i>Delete</button></li>
               @endif
            @endif

            {{ $slot }}
        </ul>
    </div>
</form>
