@forelse ($this->trainings as $training)
    <tr>
        <td>{{ $training->trainingSlot->training_date->format('d M Y, H:i') }}</td>
        <td class="d-none d-lg-table-cell">{{ $training->trainingSlot->course->title }}</td>

        @if(auth()->user()->role === 'user' || auth()->user()->role === 'leader')
            @if($training->trainingSlot->trainer)
                <td class="d-none d-lg-table-cell">{{ $training->trainingSlot->trainer->first_name }} {{ $training->trainingSlot->trainer->last_name }}</td>
            @else
                <td class="d-none d-lg-table-cell"></td>
            @endif
                @if($filter === 'all' || $filter === 'upcoming')
                <td class="d-none d-lg-table-cell">{{ $training->trainingSlot->place }}</td>
            @endif
        @endif

        @if(auth()->user()->role === 'admin')
            <td class="d-none d-md-table-cell">{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}
                <br><span class="text-muted">{{ $training->orderedBy->email }}</span>
            </td>
            @if($training->status === 'Upcoming' || $filter === 'all')
                <td class="d-none d-lg-table-cell">
                    @if($training->reminder_before_training_formatted)
                        {{ $training->reminder_before_training_formatted }}
                    @else
                        -
                    @endif
                </td>
            @endif

            @if(in_array($training->status, ['Completed','Expiring']) || $filter === 'all')
                <td class="d-none d-xl-table-cell">
                    @if($training->reminder_sent_18_m)
                        <i class="bi bi-check-lg"></i>
                    @else
                        -
                    @endif
                </td>

            @endif
        @endif

        @if($filter === 'all')
            <td class="d-none d-lg-table-cell">
                <span
{{--                 change the btn color based on what status the training has--}}
                    @class([
                        'btn btn-sm',
                        'btn-secondary' => $training->status === 'Pending',
                        'btn-primary' => $training->status === 'Upcoming',
                        'btn-success' => $training->status === 'Completed',
                        'btn-danger'  => $training->status === 'Expiring',
                    ])>
                    {{ $training->status }}
                </span>
            </td>
        @endif

{{--        trainings actions --}}
        <td>
            @include('components.elements.trainings-actions')
        </td>
    </tr>

@empty
    <tr>
        <td colspan="10">There are no trainings.</td>
    </tr>
@endforelse
