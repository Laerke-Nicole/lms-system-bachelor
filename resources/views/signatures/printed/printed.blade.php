@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('signatures.printed.printed', $trainingUser) }}

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="alert alert-primary" role="alert">
                <x-blocks.title col="col-12" title="1. Download your certificate" buttonText="Download unsigned certificate" target="_blank" href="{{ route('certificates.certificate-preview', $trainingUser) }}" subTitle="Please sign this unsigned certificate." />
            </div>
        </div>
    </div>

    <div class="row justify-content-center py-5">
        <div class="col-lg-7">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 bg-white rounded-3">

                    <div class="row">
                        <div class="mb-4">
                            <h3>2. Training completion printed signature</h3>
                            <p>Please sign by uploading a copy of your signed certificate to confirm that you completed this training and have <a href="{{ asset('storage/' . $trainingUser->assessment) }}" target="_blank" class="text-decoration-underline">read your assessment evaluation</a>.</p>
                        </div>
                    </div>

                    <x-blocks.form action="{{ route('signatures.printed.printed', $trainingUser->id) }}" method="POST" class="mb-0" x-data="{ loading: false }" @submit="loading = true">

                        <div class="mb-4">
                            <x-elements.input label="Upload an image or pdf of your printed and signed certificate" name="signed_certificate_image" type="file" col="col-md-6" />
                        </div>

                        <x-blocks.message/>

                        <button type="submit" class="btn btn-primary w-100" :disabled="loading">
                            <span x-show="!loading">Submit signature</span>
                            <span x-show="loading" class="spinner-border spinner-border-sm"></span>
                        </button>
                    </x-blocks.form>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('fixed-elements')
    <x-blocks.signature-printed-progress-bar :step="2" :trainingUser="$trainingUser" />
@endpush
