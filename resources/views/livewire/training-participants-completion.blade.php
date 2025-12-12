<div>
    <p class="text-dark fw-bold">Participants (Required to get certificate)</p>

    <x-blocks.message/>
    <x-blocks.error-alert/>

    <x-blocks.table-head :headers="['Participant', 'Completed evaluation?', 'Assessment file']">
        @forelse($trainingUsers as $participant)
            <tr>
                <td>{{ $participant->user->first_name }} {{ $participant->user->last_name }}</td>
                @if(in_array($training->status, ['Completed', 'Expired']))
                    <td>
                        <input type="hidden" name="completed_evaluation_at" value="0">

                        <x-elements.input label=""
                                          name="completed_evaluation_at"
                                          type="checkbox"
                                          value="1"
                                          class="form-check-input"
                                          col="col-5"
                                          :required="false"
                                          :checked="(bool) $participant->completed_evaluation_at"
                                          :disabled="(bool) $participant->completed_evaluation_at"
                                          wire:click="markEvaluationCompleted({{ $participant->id }})"
                                          wire:confirm="Are you sure you want to update if the participant completed the evaluation? (this cannot be undone)"
                        />
                    </td>
                @else
                    <td>-</td>
                @endif
                @if(in_array($training->status, ['Completed', 'Expired']))
                    <td>
                        <x-blocks.assessment-upload :participant="$participant" :participantId="$participant->id" />
                    </td>
                @else
                    <td>-</td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="3">There are no users.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$trainingUsers"/>
</div>
