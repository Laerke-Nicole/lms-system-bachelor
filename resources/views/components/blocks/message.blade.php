{{--display success message--}}
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

{{--display errors if there are any--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems.<br><br>
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li class="mb-3">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
