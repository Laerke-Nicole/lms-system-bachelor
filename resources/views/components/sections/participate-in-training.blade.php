@props(['participateTraining'])

@if( auth()->user()->role === 'user' || auth()->user()->role === 'leader' )
    @if($participateTraining->isNotEmpty())
        <div class="px-12">
            <div class="row">
                @foreach($participateTraining as $training)
                    @if($training->trainingSlot && $training->trainingSlot->course && $training->trainingSlot->training_date)

                        <div class="alert alert-success" role="alert">
                            <h4>
                                <button class="btn btn-success py-2 me-2 pe-none">Reminder</button>
                                You have an upcoming training</h4>
                            <p>
                                Participate in your upcoming {{ $training->trainingSlot->course->title }} training on
                                {{ $training->trainingSlot->training_date->format('d M Y') }} at
                                {{ $training->trainingSlot->training_date->format('H:i') }} UTC —
                                <a href="{{ $training->trainingSlot->participation_link }}" target="_blank" class="text-decoration-underline">
                                    participate now <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </p>

                        </div>

                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endif
