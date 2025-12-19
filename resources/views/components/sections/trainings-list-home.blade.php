<div class="mb-5">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col" class="text-label-1 text-body">Date</th>
            <th scope="col" class="text-label-1 text-body">Course</th>
            @if(auth()->user()-> role === 'admin')
                <th scope="col" class="text-label-1 text-body d-none d-md-table-cell">Ordered by</th>
            @endif
            <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Status</th>

        </tr>
        </thead>
        <tbody>
        @forelse ($trainings as $training)
            <tr class="clickable-table-row" data-href="{{ route('trainings.show', $training->id) }}">
                <td>{{ $training->trainingSlot->training_date->format('d M Y, H:i') }}</td>
                <td>{{ $training->trainingSlot->course->title }}</td>

                @if(auth()->user()->role === 'admin')
                    <td class="d-none d-md-table-cell">{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}
                        <br><span class="text-muted">{{ $training->orderedBy->email }}</span>
                    </td>
                @endif

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
            </tr>

        @empty
            <tr>
                <td colspan="10">There are no trainings.</td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <x-elements.pagination :items="$trainings"/>
</div>
