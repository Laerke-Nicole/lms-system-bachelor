@props(['training'])

@php
// since the training model has a many relation to trainingusers i need to get the specific user from the traininguser
    $trainingUser = $training->trainingUsers()->where('user_id', auth()->id())->first();
@endphp

@if($trainingUser && $trainingUser->completed_evaluation_at && !$trainingUser->certificate?->signature && $trainingUser->assessment)
    <li>
        {{--  pass the trainingUser to the signature page --}}
        <a class="dropdown-item fs-5" href="{{ route('signatures.choose', ['trainingUser' => $trainingUser]) }}">
            <i class="bi bi-pencil me-2"></i>Sign to get certificate
        </a>
    </li>
@endif
