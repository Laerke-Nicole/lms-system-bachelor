@extends('layouts.app')

@section('content')

    <div class="row section-spacing">
        <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
            <h2 class="mb-3">Your certificate is ready to be downloaded!</h2>
            <p class="lead fs-lg mb-6 px-xl-10 px-xxl-15">You can find all your certificates under <a href="{{ route('profiles.certificates') }}" class="text-decoration-underline">your profile</a> and in your <a href="{{ route('trainings.index') }}" class="text-decoration-underline">training history</a>.</p>
            <div class="mt-4">
                <a href="{{ route('certificates.certificatePdf', $certificate->training_id) }}" class="btn btn-primary">Download certificate<i class="bi bi-download ms-2"></i></a>
            </div>
        </div>
    </div>

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
                    <p class="certificate__verified-name text-black">{{ $trainingUser->signature }}</p>
                    <p class="certificate__verified-label">Participant</p>
                </div>

                <p class="certificate__valid-until">Certificate is valid until {{ $certificate->valid_until->format('d M Y') }}.</p>
            </div>
        </div>
    </div>
</div>

@endsection
