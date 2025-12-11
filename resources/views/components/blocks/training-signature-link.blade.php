@props(['training'])

@php
// see if specific user on traininguser has certificate
    $trainingUser = $training->trainingUsers()->where('user_id', auth()->id())->first();
@endphp

@if( auth()->user()->role === 'leader' || auth()->user()->role === 'user' )
    @if($trainingUser && $trainingUser->completed_evaluation_at && !$trainingUser->certificate?->signature && $trainingUser->assessment)
        <li>
            {{--  pass the trainingUser to the signature page --}}
            <a class="dropdown-item fs-5" href="{{ route('signatures.choose', ['trainingUser' => $trainingUser]) }}">
                <i class="bi bi-pencil me-2"></i>
                Sign to get certificate
            </a>
        </li>
    @endif
@endif
