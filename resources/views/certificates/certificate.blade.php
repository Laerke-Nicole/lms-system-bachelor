@extends('layouts.app')

@section('content')

<div class="certificate container py-5 section-spacing bg-white">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="certificate-container bg-white rounded-3 p-5 text-center">

                <div class="certificate__logo">
                    <img src="{{ asset('storage/' . $abInventech->logo) }}" alt="{{ basename($abInventech->logo) }}" class="certificate__image">
                </div>

                <h1 class="certificate__title">Certificate</h1>
                <p class="certificate__subtitle text-primary">OF COMPLETION</p>

                <p class="certificate__presented">presented to</p>

                <h2 class="certificate__recipient">
                    {{ $certificate->user->first_name }} {{ $certificate->user->last_name }}
                </h2>

                <p class="certificate__training">
                    for completing the training
                    {{ $certificate->training->course->title }}
                    on {{ $certificate->training->trainingSlot->training_date->format('d M Y') }}.
                </p>

                <div class="certificate__signature-block mx-auto">
                    <div class="certificate__signature-line"></div>
                    <p class="certificate__verified-name text-black">John Doe</p>
                    <p class="certificate__verified-label">Participant</p>
                </div>

                <p class="certificate__valid-until">Certificate is valid until {{ $certificate->valid_until->format('d M Y') }}.</p>

                <div class="mt-4">
                    <a href="{{ route('certificates.showCertificate', $certificate->training_id) }}" class="btn btn-primary">
                        Download certificate (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
