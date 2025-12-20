@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('signatures.digital.digital-confirm', $trainingUser) }}

    <div class="row justify-content-center section-spacing">
        <div class="col-lg-10">

            {{-- Page Title --}}
            <x-blocks.title
                col="col-12"
                title="Review your certificate"
                subTitle="Please ensure the information and your signature look correct before finalizing it."
            />

            <div class="row mt-4">

                {{-- Certificate Preview --}}
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0">
                            <h5 class="mb-0">Certificate Preview</h5>
                            <p class="text-muted small mb-0">This is how your certificate is going to appear once finalized.</p>
                        </div>

                        <div class="card-body p-0">
                            <iframe src="{{ route('certificates.certificate-preview', ['trainingUser' => $trainingUser, 'stream' => true]) }}#toolbar=0&navpanes=0&scrollbar=0" class="w-100 certificate__preview" title="Certificate Preview"></iframe>
                        </div>
                    </div>
                </div>

                {{-- Action Panel --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 bg-white booking-sidebar">
                        <div class="card-body">

                            <h5 class="mb-3 fw-bold">Next step</h5>
                            <p class="text-muted small">If you're satisfied with your signature on the certificate, confirm signature. Otherwise, you can upload a new signature image.</p>

                            <div class="d-flex flex-column gap-3 mt-4">

                                <a href="{{ route('signatures.digital.digital', $trainingUser) }}"
                                   class="btn btn-outline-primary w-100">
                                    Upload new signature
                                </a>

                                <x-blocks.form action="{{ route('signatures.digital.digital-submit', $trainingUser) }}" method="POST" class="mb-0" x-data="{ loading: false }" @submit="loading = true">
                                    <button type="submit" class="btn btn-primary w-100" :disabled="loading">
                                        <span x-show="!loading">Confirm</span>
                                        <span x-show="loading" class="spinner-border spinner-border-sm"></span>
                                    </button>
                                </x-blocks.form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('fixed-elements')
    <x-blocks.signature-digital-progress-bar :step="3" :trainingUser="$trainingUser" />
@endpush
