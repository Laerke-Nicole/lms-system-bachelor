@props(['training'])

@if(in_array($training->status, ['Completed', 'Expired']) && $training->trainingSlot->course->evaluation)
    <li><hr class="dropdown-divider"></li>

    <li>
        <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->course->evaluation->evaluation_link }}" target="_blank">
            <i class="bi bi-clipboard-check me-2"></i>Take evaluation (required)
        </a>
    </li>
@endif
