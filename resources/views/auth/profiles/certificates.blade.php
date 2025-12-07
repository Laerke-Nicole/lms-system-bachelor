@extends('layouts.profile')

@section('profile-content')

    <h3 class="mb-5">Certificates</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <x-blocks.table-head
        :headers="['Course', 'Training date', 'Valid Until', 'PDF']">
        @forelse ($certificates as $certificate)
            <tr>
                <td>{{ $certificate->training->course->title ?? 'No course' }}</td>
                <td>{{ $certificate->training->trainingSlot->training_date->format('d M Y') }}</td>
                <td>{{ $certificate->valid_until->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('certificates.certificatePdf', $certificate->training_id) }}"><i class="bi bi-download me-2"></i>Download</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">You have no certificates.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


@endsection
