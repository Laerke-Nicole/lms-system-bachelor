@extends('layouts.profile')

@section('profile-content')


    <h3 class="mb-5">Certificates</h3>

    <x-blocks.table-head
        :headers="['Course', 'Training date', 'Valid Until', 'Download']">
        @forelse ($user->certificates as $certificate)
            <tr>
                <td>{{ $certificate->training->course->title ?? 'No course' }}</td>
                <td>{{ $certificate->training->training_date->format('d M Y H:i') }}</td>
                <td>{{ $certificate->training->date->format('d M Y') }}</td>
                <td>
                    @if($certificate->url)
                        <a href="{{ $certificate->url }}" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">You have no certificates.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


@endsection
