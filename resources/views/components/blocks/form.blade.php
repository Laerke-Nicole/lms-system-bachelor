<form action="{{ $action }}" method="{{ $method }}" class="{{ $class ?? null }}" {{ $attributes->merge(['enctype' => 'multipart/form-data']) }}>
    @csrf

    {{ $slot }}

</form>
