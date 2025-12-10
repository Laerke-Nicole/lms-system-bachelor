@props(['training'])

@php
    // since the training model has a many relation to trainingusers i need to get the specific user from the traininguser
        $trainingUser = $training->trainingUsers()->where('user_id', auth()->id())->first();
@endphp

@if(in_array($training->status, ['Completed', 'Expired']) && $training->trainingSlot->course->evaluation && $trainingUser && !$trainingUser->completed_evaluation_at)
    <li><hr class="dropdown-divider"></li>

    <li>
        <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->course->evaluation->evaluation_link }}" target="_blank">
            <i class="bi bi-clipboard-check me-2"></i>Take evaluation (required)
        </a>
    </li>
@endif
