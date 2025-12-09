@props(['training'])

@if($training->status === 'Upcoming' && $training->trainingSlot->training_date->isToday())
    <li><hr class="dropdown-divider"></li>
    <li>
        <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->participation_link }}" target="_blank">
            <i class="bi bi-person-workspace me-2"></i>Participate in training
        </a>
    </li>
@endif
