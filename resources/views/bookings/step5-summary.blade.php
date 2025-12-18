@extends('layouts.app')

@section('content')
    <div class="row step5">
        <div class="col-lg-5 p-0 d-none d-lg-block">
            <img src="https://cdn.pixabay.com/photo/2015/06/23/08/16/daegwallyeong-818420_1280.jpg" alt="windmill" class="img-fluid w-100 min-vh-100 h-100 object-fit-cover">
        </div>

        <div class="col-12 col-lg-7 booking-section">
            <div class="p-lg-5">
                <div>
                    <p class="step5__eyebrow mb-2 text-primary text-label-1">Thank you for booking</p>
                    <h1 class="step5__title mb-3">Booking successful</h1>
                    <p class="step5__content mb-5 pb-2">We have received your booking. You can see it in your pending trainings tab.</p>
                </div>

                <hr>

                @if($training->trainingSlot && $training->trainingSlot->course)
                    <div class="row mb-3 g-3">
                        <div class="col-sm-3 col-lg-4">
                            @if($training->trainingSlot->course->image)
                                <img src="{{ asset('storage/' . $training->trainingSlot->course->image) }}"
                                     alt="{{ $training->trainingSlot->course->title }}"
                                     class="h-100 w-100 object-fit-cover rounded">
                            @else
                                <img src="storage/placeholder.png" alt="Course" class="h-100 w-100 object-fit-cover rounded">
                            @endif
                        </div>

                        <div class="col-sm-9 col-lg-8 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="fw-semibold">{{ $training->trainingSlot->course->title }}</h4>
                                @if($training->trainingSlot->course->description)
                                    <p class="small text-muted mb-5">{{ $training->trainingSlot->course->description }}</p>
                                @endif
                            </div>
                            <div class="d-flex gap-4 align-items-center small">
                                @if($training->trainingSlot->training_date)
                                    <p class="mb-0"><span class="text-dark">Date </span>{{ $training->trainingSlot->training_date->format('d M Y, H:i') }}</p>
                                @endif
                                @if($training->trainingSlot->place)
                                    <span class="opacity-25">|</span>
                                    <p class="mb-0"><span class="text-dark">Location </span> {{ $training->trainingSlot->place }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <hr>

                @if($training->users && $training->users->count() > 0)
                    <div class="d-flex flex-column gap-2 mt-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted small">Participants</p>
                            </div>
                            <div>
                                @foreach($training->users as $user)
                                    @if($user->first_name || $user->last_name)
                                        <p class="step5__employees text-dark text-end small">{{ $user->first_name }} {{ $user->last_name }}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <hr class="mb-5">

                <div class="col-lg-6">
                    <h4 class="mb-3">What happens next?</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2 small">The training will now appear under “Pending trainings” in your dashboard.</li>
                        <li class="mb-3 small">You’ll receive a reminder to rebook this training 18 months before it expires.</li>
                    </ul>
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to dashboard</a>
                </div>

            </div>
        </div>
    </div>


@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="5" />
@endpush
