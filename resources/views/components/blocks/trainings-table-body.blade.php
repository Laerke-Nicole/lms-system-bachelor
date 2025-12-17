@forelse ($this->trainings as $training)
    <tr>
        <td>{{ $training->trainingSlot->training_date->format('d M Y, H:i') }}</td>
        <td>{{ $training->trainingSlot->course->title }}</td>
        @if(auth()->user()->role === 'user' || auth()->user()->role === 'leader')
            <td>{{ $training->trainingSlot->trainer->first_name }} {{ $training->trainingSlot->trainer->last_name }}</td>
            @if($filter === 'all' || $filter === 'upcoming')
                <td>{{ $training->trainingSlot->place }}</td>
            @endif
        @endif

        @if(auth()->user()->role === 'admin')
            <td>{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}
                <br><span class="text-muted">{{ $training->orderedBy->email }}</span>
            </td>
            @if($training->status === 'Upcoming' || $filter === 'all')
                <td>
                    @if($training->reminder_before_training_formatted)
                        {{ $training->reminder_before_training_formatted }}
                    @else
                        -
                    @endif
                </td>
            @endif
            @if(in_array($training->status, ['Completed','Expiring']) || $filter === 'all')
                <td>
                    @if($training->reminder_sent_18_m)
                        <i class="bi bi-check-lg"></i>
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if($training->reminder_sent_22_m)
                        <i class="bi bi-check-lg"></i>
                    @else
                        -
                    @endif
                </td>

            @endif
        @endif
        @if($filter === 'all')
            <td>
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

        <td>
            @include('components/elements/trainings-actions')
        </td>
    </tr>

@empty
    <tr>
        <td colspan="10">There are no trainings.</td>
    </tr>
@endforelse
