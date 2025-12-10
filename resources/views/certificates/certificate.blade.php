@extends('layouts.app')

@section('content')

    <div class="row section-spacing">
        <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
            <h2 class="mb-3">Your certificate is ready to be downloaded!</h2>
            <p class="lead fs-lg mb-6 px-xl-10 px-xxl-15">You can find all your certificates under <a href="{{ route('profiles.certificates') }}" class="text-decoration-underline">your profile</a> and in your <a href="{{ route('trainings.index') }}" class="text-decoration-underline">training history</a>.</p>
            @if($certificate && $certificate->signature)
                @if($certificate->signature->signature_image)
                    <div class="mt-4">
                        <a href="{{ route('certificates.certificatePdf', $certificate->trainingUser->training_id) }}" class="btn btn-primary">Download certificate<i class="bi bi-download ms-2"></i></a>
                    </div>
                @elseif($certificate->signature->signed_certificate_pdf)
                    <div class="mt-4">
                        <a href="{{ asset('storage/' . $certificate->signature->signed_certificate_pdf) }}" class="btn btn-primary" download>Download certificate<i class="bi bi-download ms-2"></i></a>
                    </div>
                @endif
            @endif
        </div>
    </div>

<div class="certificate container py-5 section-spacing bg-white">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="certificate-container bg-white rounded-3 p-5 text-center">

                @if($abInventech && $abInventech->logo)
                    <div class="certificate__logo">
                        <img src="{{ asset('storage/' . $abInventech->logo) }}" alt="{{ basename($abInventech->logo) }}" class="certificate__image">
                    </div>
                @endif

                <h1 class="certificate__title">Certificate</h1>
                <p class="certificate__subtitle text-primary">OF COMPLETION</p>

                <p class="certificate__presented">presented to</p>

                @if($certificate && $certificate->trainingUser && $certificate->trainingUser->user)
                    <h2 class="certificate__recipient">
                        {{ $certificate->trainingUser->user->first_name }} {{ $certificate->trainingUser->user->last_name }}
                    </h2>
                @endif

                @if($certificate && $certificate->trainingUser && $certificate->trainingUser->training->course && $certificate->trainingUser->training->trainingSlot)
                    <p class="certificate__training">
                        for completing the training
                        {{ $certificate->trainingUser->training->course->title }}
                        on {{ $certificate->trainingUser->training->trainingSlot->training_date->format('d M Y') }}.
                    </p>
                @endif

                @if($certificate && $certificate->signature)
                    <div class="certificate__signature-block mx-auto">
                        <img src="{{ asset('storage/' . $certificate->signature->signature_image) }}" alt="{{ basename($certificate->signature->signature_image) }}" class="mb-1 w-100 object-fit-cover">
                        <div class="certificate__signature-line"></div>
                        <p class="certificate__verified-label">Participant</p>
                    </div>
                @endif

                @if($certificate && $certificate->valid_until)
                    <p class="certificate__valid-until">Certificate is valid until {{ $certificate->valid_until->format('d M Y') }}.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
