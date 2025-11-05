@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="mb-3">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
