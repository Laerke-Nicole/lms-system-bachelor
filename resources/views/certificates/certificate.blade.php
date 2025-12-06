@extends('layouts.app')

@section('content')

<div class="row">
    <h2>
        Certificate of completion
    </h2>

    <p>This certificate is presented to:</p>
    <h3>{{ $certificate->user->first_name }} {{ $certificate->user->last_name }}</h3>
    <p>for completing the training {{ $certificate->training->course->title }} the {{ $certificate->training->trainingSlot->training_date->format('d M Y') }}</p>
</div>


@endsection
