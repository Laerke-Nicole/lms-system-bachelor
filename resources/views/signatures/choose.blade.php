@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('signatures.choose', $trainingUser ) }}

    <x-blocks.title title="Choose how you wish to sign your certificate" />

    <div class="row">
        <div class="col-lg-8">
            <div class="row g-3 mb-3">
                <div class="col-lg-6">
                    <a href="{{ route('signatures.digital.digital', $trainingUser) }}">
                        <div class="align-content-between justify-content-between bg-white rounded-3 shadow-sm p-4">
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <i class="bi bi-laptop fs-1"></i>
                                </div>
                                <h3>Digital signing</h3>
                                <p>Simply upload an image of your signature.</p>
                                <button class="btn btn-outline-primary d-flex gap-2 align-items-center">
                                    Upload image
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                            <div class="col-lg-5">
                                <img src="" alt="">
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-6">
                    <a href="{{ route('signatures.printed.printed', $trainingUser) }}">
                        <div class="align-content-between justify-content-between bg-white rounded-3 shadow-sm p-4">
                            <div class="col-lg-7">
                                <div class="mb-3">
                                    <i class="bi bi-printer fs-1"></i>
                                </div>
                                <h3>Printed signing</h3>
                                <p>Print out an unsigned certificate, sign it by hand and then upload your signed copy.</p>
                                <button class="btn btn-outline-primary d-flex gap-2 align-items-center">
                                    Print, scan, upload
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                            <div class="col-lg-5">
                                <img src="" alt="">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        @if($trainingUser->assessment)
            <div class="col-lg-4">
                <div class="alert alert-primary" role="alert">
                    Please review your assessment before continuing.
                    <a href="{{ asset('storage/' . $trainingUser->assessment) }}" target="_blank" class="text-decoration-underline">You can open the PDF here</a>.
                </div>
            </div>
        @endif
    </div>

@endsection

@push('fixed-elements')
    <x-blocks.signature-digital-progress-bar :step="1" :trainingUser="$trainingUser" />
@endpush
