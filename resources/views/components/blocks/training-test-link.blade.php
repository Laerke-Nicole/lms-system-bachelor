@props(['training'])

@if(in_array($training->status, ['Completed', 'Expired']) && $training->trainingSlot->course->followUpTest)
    <li>
        <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->course->followUpTest->test_link }}" target="_blank">
            <i class="bi bi-journal me-2"></i>Take test
        </a>
    </li>
@endif
