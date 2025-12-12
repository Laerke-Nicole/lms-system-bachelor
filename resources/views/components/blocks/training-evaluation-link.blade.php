@props(['training'])

@php
    // see if specific user on traininguser has completed evaluation
        $trainingUser = $training->trainingUsers()->where('user_id', auth()->id())->first();
@endphp

@if( auth()->user()->role === 'leader' || auth()->user()->role === 'user' )
    @if(in_array($training->status, ['Completed', 'Expired']) && $training->trainingSlot->course->evaluation && $trainingUser && !$trainingUser->completed_evaluation_at)
        <li><hr class="dropdown-divider"></li>

        <li>
            <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->course->evaluation->evaluation_link }}" target="_blank">
                <i class="bi bi-clipboard-check me-2"></i>
                Take evaluation (required)
            </a>
        </li>
    @endif
@endif
