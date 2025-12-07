<div>
{{--    filtering btns with active and inactive state --}}
    <div class="d-flex gap-2 mb-3">
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

                @if($filter === 'all' || $filter === 'upcoming')
                    <td>{{ $training->trainingSlot->place }}</td>
                @endif

                @if($training->status === 'Upcoming' || $filter === 'all')
                    <td>{{ $training->reminder_before_training_formatted ?? '-' }}</td>
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
                                            :deleteRoute="route('trainings.destroy', $training->id)">
                        @if($training->status === 'Upcoming' && $training->trainingSlot->training_date->isToday())
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->participation_link }}" target="_blank">
                                    <i class="bi bi-person-workspace me-2"></i>Participate in training
                                </a>
                            </li>
                        @endif

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item fs-5" href="{{ route('courses.course_materials.index', $training->course) }}">
                                <i class="bi bi-file-earmark-text me-2"></i>Course material
                            </a>
                        </li>

{{--                        show link to test and evaluation if the status is completed or expired --}}
                        @if(in_array($training->status, ['Completed', 'Expired']))

{{--                            show evaluation --}}
                            @if(in_array($training->status, ['Completed', 'Expired']) && $training->trainingSlot->course->evaluation)
                                <li>
                                    <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->course->evaluation->evaluation_link }}" target="_blank">
                                        <i class="bi bi-clipboard-check me-2"></i>Take evaluation
                                    </a>
                                </li>
                            @endif

{{--                            show test --}}
                            @if(in_array($training->status, ['Completed', 'Expired']) && $training->trainingSlot->course->followUpTest)
                                <li>
                                    <a class="dropdown-item fs-5" href="{{ $training->trainingSlot->course->followUpTest->test_link }}" target="_blank">
                                        <i class="bi bi-journal me-2"></i>Take test
                                    </a>
                                </li>
                            @endif

{{--                            show signature page if the user completed test and evalution and didnt sign yet --}}
{{--                                @if($training->trainingUsers->completed_test_at && $training->trainingUsers->completed_evaluation_at && !$training->trainingUsers->signed_at)--}}
                                    <li>
{{--                                        pass the training id to the signature page --}}
                                        <a class="dropdown-item fs-5" href="{{ route('signatures.index', ['training_id' => $training->id]) }}">
                                            <i class="bi bi-pencil me-2"></i>Sign to get certificate
                                        </a>
                                    </li>
{{--                                @endif--}}
                        @endif
                    </x-blocks.table-actions>
                </td>
            </tr>

{{--        show course material if status is upcoming, completed or expired --}}
            @if (in_array($training->status, ['Upcoming', 'Completed', 'Expired']))
                <x-blocks.course-materials :training="$training" :tableHeaders="$this->tableHeaders" />
            @endif

        @empty
            <tr>
                <td colspan="{{ count($this->tableHeaders) }}">There are no trainings.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$this->trainings"/>
</div>
