<div>
{{--    filtering btns with active and inactive state --}}
    <div class="d-flex gap-2">
        <button class="{{ $filter === 'all' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('all')">All</button>
        <button class="{{ $filter === 'upcoming' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('upcoming')">Upcoming</button>
        <button class="{{ $filter === 'completed' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('completed')">Completed</button>
        <button class="{{ $filter === 'expired' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('expired')">Expired</button>
    </div>

    <x-blocks.table-head :headers="$this->tableHeaders">
        @forelse ($this->trainings as $training)
            <tr>
                <td>{{ $training->trainingSlot->training_date->format('d M Y, H:i') }}</td>
                <td>{{ $training->trainingSlot->course->title }}</td>
                <td>{{ $training->trainingSlot->trainer->first_name }} {{ $training->trainingSlot->trainer->last_name }}</td>
                <td>{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}</td>

                @if($filter === 'all' || 'Upcoming')
                    <td>{{ $training->trainingSlot->place }}</td>
                @endif

                @if($training->status === 'Upcoming' || $filter === 'all')
                    <td>{{ $training->reminder_before_training_formatted }}</td>
                @endif

                @if(in_array($training->status, ['Completed','Expired']) || $filter === 'all')
                    <td>{{ $training->reminder_sent_18_m ? 'Yes' : 'No' }}</td>
                    <td>{{ $training->reminder_sent_22_m ? 'Yes' : 'No' }}</td>
                @endif
                @if($filter === 'all')
                    <td>{{ $training->status }}</td>
                @endif
                <td>
                    <x-blocks.table-actions :showRoute="route('trainings.show', $training->id)"
                                            :editRoute="route('trainings.edit', $training->id)"
                                            :deleteRoute="route('trainings.destroy', $training->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">There are no upcoming trainings.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$this->trainings"/>
</div>
