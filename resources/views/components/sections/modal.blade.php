<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $id }}">
    <i class="bi bi-pencil"></i>
</button>

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $modalLabel }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $modalLabel }}">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Change password</button>--}}
{{--                <a href="" class="btn btn-outline-primary">Cancel</a>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
