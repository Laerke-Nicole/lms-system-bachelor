<div>
{{--    filtering btns with active and inactive state --}}
    <div class="d-flex gap-2 mb-3">
        <button class="{{ $filter === 'all' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('all')">All</button>
        <button class="{{ $filter === 'upcoming' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('upcoming')">Upcoming</button>
        <button class="{{ $filter === 'completed' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('completed')">Completed</button>
        <button class="{{ $filter === 'expired' ? 'btn btn-primary btn-sm' : 'btn btn-outline-primary btn-sm' }}" wire:click="setFilter('expired')">Expired</button>
    </div>

    <x-blocks.trainings-table-head :filter="$filter">
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
                    <td>{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}</td>
                    @if($training->status === 'Upcoming' || $filter === 'all')
                        <td>{{ $training->reminder_before_training_formatted ?? '-' }}</td>
                    @endif
                    @if(in_array($training->status, ['Completed','Expired']) || $filter === 'all')
                        <td>{{ $training->reminder_sent_18_m ? '✔' : '-' }}</td>
                        <td>{{ $training->reminder_sent_22_m ? '✔' : '-' }}</td>
                    @endif
                @endif
                @if($filter === 'all')
                    <td>
                        <span
{{--                            change the btn color based on what status the training has--}}
                            @class([
                                'btn btn-sm',
                                'btn-primary' => $training->status === 'Upcoming',
                                'btn-success' => $training->status === 'Completed',
                                'btn-danger'  => $training->status === 'Expired',
                            ])>
                            {{ $training->status }}
                        </span>
                    </td>
                @endif
                <td>
                    <x-blocks.table-actions :showRoute="route('trainings.show', $training->id)"
                                            :editRoute="route('trainings.edit', $training->id)"
                                            :deleteRoute="route('trainings.destroy', $training->id)">

                        {{--                        the button to participate in training --}}
                        <x-blocks.training-participation-link :training="$training" />

                        {{--                        show course material --}}
                        <x-blocks.training-course-materials-link :training="$training" />

                        {{--                         show test --}}
                        <x-blocks.training-test-link :training="$training" />

                        {{--                         show evaluation --}}
                        <x-blocks.training-evaluation-link :training="$training" />

                        {{--                         show signature page if the user completed evalution and didnt sign yet --}}
                        <x-blocks.training-signature-link :training="$training" />

                    </x-blocks.table-actions>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="{{ count($this->tableHeaders) }}">There are no trainings.</td>
            </tr>
        @endforelse
    </x-blocks.trainings-table-head>


    <x-elements.pagination :items="$this->trainings"/>
</div>
