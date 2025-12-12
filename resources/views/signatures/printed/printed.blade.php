@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="alert alert-primary" role="alert">
                <x-blocks.title col="col-12" title="Download your certificate" buttonText="Download unsigned certificate" target="_blank" href="{{ route('certificates.unsigned', $trainingUser) }}" subTitle="Please sign this unsigned certificate." />
            </div>
        </div>
    </div>

    <div class="row justify-content-center py-5">
        <div class="col-lg-7">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 bg-white rounded-3">

                    <div class="row">
                        <div class="mb-4">
                            <h3>Training completion signature</h3>
                            <p>Please sign by uploading a copy of your signed certificate to confirm that you completed this training and have <a href="{{ asset('storage/' . $trainingUser->assessment) }}" target="_blank" class="text-decoration-underline">read your assessment evaluation</a>.</p>
                        </div>
                    </div>

                    <x-blocks.form action="{{ route('signatures.printed.printed', $trainingUser->id) }}" method="POST" class="mb-0">

                        <div class="mb-4">
                            <x-elements.input label="Upload an image or pdf of your printed and signed certificate" name="signed_certificate_image" type="file" col="col-md-6" />
                        </div>

                        <x-blocks.error-alert/>

                        <button type="submit" class="btn btn-primary w-100">Submit signature</button>
                    </x-blocks.form>

                </div>
            </div>

        </div>
    </div>
@endsection
