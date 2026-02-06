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
        <x-blocks.table-head :headers="[
        ['label' => 'Course'],
        ['label' => 'Training date', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Valid Until', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'PDF'],
        ]">
            @forelse ($certificates as $certificate)
                <tr>
                    <td>
                        @if($certificate->trainingUser && $certificate->trainingUser->training->course)
                            {{ $certificate->trainingUser->training->course->title }}
                        @else
                            No course
                        @endif
                    </td>
                    <td class="d-none d-md-table-cell">
                        @if($certificate->trainingUser && $certificate->trainingUser->training->trainingSlot && $certificate->trainingUser->training->trainingSlot->training_date)
                            {{ $certificate->trainingUser->training->trainingSlot->training_date->format('d M Y') }}
                        @else
                            No training date
                        @endif
                    </td>
                    <td class="d-none d-lg-table-cell">
                        @if($certificate->valid_until)
                            {{ $certificate->valid_until->format('d M Y') }}
                        @else
                            No expiration date set
                        @endif
                    </td>
                    <td>
                        @if($certificate->trainingUser->signature->signature_image)
                            <div>
                                <a href="{{ route('certificates.certificatePdf', $certificate->trainingUser->training_id) }}"
                                   target="_blank"><i class="bi bi-download me-2"></i>Download</a>
                            </div>
                        @elseif($certificate->trainingUser->signature->signed_certificate_image)
                            <div>
                                <a href="{{ uploads_url($certificate->trainingUser->signature->signed_certificate_image) }}"
                                   target="_blank"><i class="bi bi-download me-2"></i>Download</a>
                            </div>
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
