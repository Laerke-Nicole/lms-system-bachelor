<form action="{{ $action }}" method="{{ $method }}" class="{{ $class ?? null }}">
    @csrf

    {{ $slot }}

</form>
