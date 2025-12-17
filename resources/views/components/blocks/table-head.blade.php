@props(['headers'])

<table class="table align-middle">
    <thead>
    <tr>
        @foreach ($headers as $header)
            <th scope="col" class="text-label-1 text-body {{ $header['class'] ?? '' }}">{{ $header['label'] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    {{ $slot }}
    </tbody>
</table>
