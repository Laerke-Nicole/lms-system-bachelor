@props(['training'])

@php
    // see if specific user on traininguser is their training to join
        $trainingUser = $training->trainingUsers()->where('user_id', auth()->id())->first();
@endphp

@if( auth()->user()->role === 'leader' || auth()->user()->role === 'user' )
    @if($training->status === 'Upcoming' && $training->trainingSlot->training_date->isToday())
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->participation_link }}" target="_blank">
                <i class="bi bi-person-workspace me-2"></i>
                Participate in training
            </a>
        </li>
    @endif
@endif
