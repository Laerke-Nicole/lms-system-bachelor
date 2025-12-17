@props(['training'])

@if( auth()->user()->role === 'leader' || auth()->user()->role === 'user' )
    @if (in_array($training->status, ['Upcoming', 'Completed', 'Expiring']) && $training->trainingSlot->course->courseMaterials)
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item fs-5" href="{{ route('sections.course-materials', $training->id) }}">
                <i class="bi bi-file-earmark-text me-2"></i>
                Course material
            </a>
        </li>
    @endif
@endif
