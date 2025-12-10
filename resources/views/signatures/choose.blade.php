@extends('layouts.app')

@section('content')

    <x-blocks.title title="Choose how you wish to sign your certificate" />

    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('signatures.digital', $trainingUser) }}">
                <div class="align-content-between justify-content-between bg-white rounded-3 shadow-sm p-4">
                    <div>
                        <h4>Upload an image of your signature</h4>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <p>Upload image</p>
                            <div class="pe-none bg-primary text-light p-2 me-4 rounded-circle">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('signatures.printed', $trainingUser) }}">
                <div class="align-content-between justify-content-between bg-white rounded-3 shadow-sm p-4">
                    <div>
                        <h4>Print out an unsigned certificate, sign it by hand and then upload your signed copy</h4>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between">
                            <p>Print, scan, upload</p>
                            <div class="pe-none bg-primary text-light p-2 me-4 rounded-circle">
                                <i class="bi bi-arrow-up-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
