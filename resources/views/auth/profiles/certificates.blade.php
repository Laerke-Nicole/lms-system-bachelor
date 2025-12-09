@extends('layouts.profile')

@section('profile-content')

    <h3 class="mb-5">Certificates</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

{{--    list of the users certificates--}}
    @if($certificates)
        <x-blocks.table-head
            :headers="['Course', 'Training date', 'Valid Until', 'PDF']">
            @forelse ($certificates as $certificate)
                <tr>
                    <td>
                        @if($certificate->training && $certificate->training->course)
                            {{ $certificate->training->course->title }}
                        @else
                            No course
                        @endif
                    </td>
                    <td>
                        @if($certificate->training && $certificate->training->trainingSlot && $certificate->training->trainingSlot->training_date)
                            {{ $certificate->training->trainingSlot->training_date->format('d M Y') }}
                        @else
                            No training date
                        @endif
                    </td>
                    <td>
                        @if($certificate->valid_until)
                            {{ $certificate->valid_until->format('d M Y') }}
                        @else
                            No expiration date set
                        @endif
                    </td>
                    <td>
                        @if($certificate->training_id)
                            <a href="{{ route('certificates.certificatePdf', $certificate->training_id) }}"><i class="bi bi-download me-2"></i>Download</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">You have no certificates.</td>
                </tr>
            @endforelse
        </x-blocks.table-head>
    @endif


@endsection
