@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('bookings.summary') }}

    <h3 class="mb-5">Choose a course</h3>


@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="4" />
@endpush
