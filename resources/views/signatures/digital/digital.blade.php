@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4 bg-white rounded-3">

                        <x-blocks.title col="col-12" title="Training completion signature" subTitle="Please sign by uploading an image of your signature to confirm that you completed this training." />

                        <x-blocks.form action="{{ route('signatures.digital.digital', $trainingUser->id) }}" method="POST" class="mb-0">

                            <div class="mb-4">
                                <x-elements.input label="Upload an image of your signature" name="signature_image" type="file" col="col-md-6" />
                            </div>

                            <x-blocks.message/>

{{--                        confirmation checkbox --}}
                            <div class="col-12">
                                <div class="form-check mb-3 d-flex gap-2">
                                    <input
                                        type="checkbox"
                                        name="signature_confirmed"
                                        value="1"
                                        class="form-check-input"
                                        required
                                    >
                                    <label class="form-label">I hereby confirm my signature is correct, I completed the required training and evaluation, and have
                                        <a href="{{ asset('storage/' . $trainingUser->assessment) }}" target="_blank" class="text-decoration-underline">read my assessment evaluation</a>.
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Continue</button>
                        </x-blocks.form>

                    </div>
                </div>

                <div class="alert alert-primary" role="alert">
                    <strong>Note:</strong> For the best result leave as little empty space around the signature as possible.
                </div>

            </div>
        </div>
    </div>
@endsection

@push('fixed-elements')
    <x-blocks.signature-digital-progress-bar :step="2" :trainingUser="$trainingUser" />
@endpush
