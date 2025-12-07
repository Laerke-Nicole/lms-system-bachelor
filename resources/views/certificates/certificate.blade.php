@extends('layouts.app')

@section('content')

    <div class="certificate container py-5 background-image-main">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5 bg-white rounded-3 text-center">

{{--                        logo --}}
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $abInventech->logo) }}"
                                 alt="{{ basename($abInventech->logo) }}"
                                 class="certificate__image img-fluid">
                        </div>

{{--                        title --}}
                        <h1 class="certificate__title">Certificate</h1>
                        <p class="certificate__subtitle text-uppercase text-primary">of completion</p>

{{--                        recipient --}}
                        <p class="certificate__presented">presented to</p>
                        <h2 class="certificate__recipient">
                            {{ $certificate->user->first_name }} {{ $certificate->user->last_name }}
                        </h2>

{{--                        training description--}}
                        <p class="certificate__training">
                            for completing the training {{ $certificate->training->course->title }} on {{ $certificate->training->trainingSlot->training_date->format('d M Y') }}.
                        </p>

{{--                        signature --}}
                        <div class="certificate__signature-block mx-auto">
                            <div class="certificate__signature-line"></div>
                            <p class="certificate__verified-name">Nicholas Nielsen</p>
                            <p class="certificate__verified-label">Verified by</p>
                        </div>

{{--                        valid until--}}
                        <p class="certificate__valid-until text-label-1">
                            Certificate is valid until
                            {{ $certificate->valid_until->format('d M Y') }}.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
