@extends('layouts.app')

@section('content')

    <div class="row section-spacing">
        <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
            <h2 class="mb-3">Your certificate is ready to be downloaded!</h2>
            <p class="lead fs-lg mb-6 px-xl-10 px-xxl-15 mb-4">You can find all your certificates under <a href="{{ route('profiles.certificates') }}" class="text-decoration-underline">your profile</a> and in your <a href="{{ route('trainings.index') }}" class="text-decoration-underline">training history</a>.</p>
            @if($certificate && $certificate->signature)
                <div class="d-flex gap-2 align-items-center justify-content-center">
    {{--                if user signed with uploading signature image --}}
                    @if($certificate->signature->signature_image)
                        <div>
                            <a href="{{ route('certificates.certificatePdf', $certificate->trainingUser->training_id) }}" class="btn btn-primary" target="_blank">Get certificate<i class="bi bi-download ms-2"></i></a>
                        </div>
    {{--                    if user signed by printing --}}
                    @elseif($certificate->signature->signed_certificate_image)
                        <div>
                            <a href="{{ uploads_url($certificate->signature->signed_certificate_image) }}" class="btn btn-primary" target="_blank">Get certificate<i class="bi bi-download ms-2"></i></a>
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">Return to dashboard</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
