@extends('layouts.app')

@section('content')

    <div class="row">
        @forelse($participateTraining as $training)
            <div class="col-12">
                <h3>You have an upcoming training</h3>
                <p>Participate in our Whatsapp call and start your training on {{ $training->trainingSlot->training_date->format('d M Y') }} at {{ $training->trainingSlot->training_date->format('H:i') ?? null }} UTC.</p>
                <a href="{{ $training->trainingSlot->participation_link }}" target="_blank" class="btn btn-secondary">Participate</a>
            </div>
        @empty
            <div class="col-12">
                <p>You have no trainings starting soon.</p>
            </div>
        @endforelse
    </div>

@endsection
