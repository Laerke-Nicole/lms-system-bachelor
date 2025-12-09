@props(['training'])

@if($training->trainingUsers->completed_evaluation_at && !$training->trainingUsers->signed_at)
    <li>
        {{--  pass the training id to the signature page --}}
        <a class="dropdown-item fs-5" href="{{ route('signatures.index', ['training_id' => $training->id]) }}">
            <i class="bi bi-pencil me-2"></i>Sign to get certificate
        </a>
    </li>
@endif
