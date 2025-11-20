@props(['headers'])

<table class="table">
    <thead>
    <tr>
        @foreach ($headers as $header)
            <th scope="col" class="text-label-1 text-body">{{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    {{ $slot }}
    </tbody>
</table>
