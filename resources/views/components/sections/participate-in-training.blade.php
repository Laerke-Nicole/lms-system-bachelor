@props(['participateTraining'])

@if($participateTraining->isNotEmpty())

    <div class="row bg-primary section-box">

        @forelse($participateTraining as $training)
            @if($training->trainingSlot && $training->trainingSlot->course && $training->trainingSlot->training_date)
                <div class="col-lg-10 col-xl-9 col-xxl-8 mx-auto text-center">
                    <p class="text-white">You have an upcoming training</p>
                    <h3 class="text-white mb-4 display-1 fw-bold letter-spacing-normal">
                        Participate in your upcoming {{ $training->trainingSlot->course->title }} training
                        on {{ $training->trainingSlot->training_date->format('d M Y') }}
                        at {{ $training->trainingSlot->training_date->format('H:i') }} UTC.
                    </h3>
                    @if($training->trainingSlot->participation_link)
                        <a href="{{ $training->trainingSlot->participation_link }}" target="_blank" class="btn btn-light">Participate now</a>
                    @endif
                </div>
            @endif
        @empty

        @endforelse
    </div>
@endif
