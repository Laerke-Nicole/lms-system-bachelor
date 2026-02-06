<div>
    <p class="text-dark fw-bold">Participants</p>

    <x-blocks.message/>

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col" class="text-label-1 text-body">Participant</th>
            @if(auth()->user()->role === 'admin')
                <th scope="col" class="text-label-1 text-body">Completed evaluation?</th>
            @endif
            <th scope="col" class="text-label-1 text-body d-none d-md-table-cell">Assessment file</th>
            @if(auth()->user()->role === 'leader')
                <th scope="col" class="text-label-1 text-body">Certificate</th>
            @endif
        </tr>
        </thead>
        <tbody>
            @forelse($trainingUsers as $participant)
                <tr>
                    {{--                users name --}}
                    <td>{{ $participant->user->first_name }} {{ $participant->user->last_name }}
                        <br><span class="text-muted">{{ $participant->user->email }}</span>
                    </td>

                    {{--                checkbox if they completed evaluation --}}
                    @if(auth()->user()->role === 'admin')
                        @if(in_array($training->status, ['Completed', 'Expiring']))
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
                    @endif

                    {{--                assessment --}}
                    @if(in_array($training->status, ['Completed', 'Expiring']))
                        <td class="d-none d-md-table-cell">
                            <x-blocks.assessment-upload :participant="$participant" :participantId="$participant->id" />
                        </td>
                    @else
                        <td>-</td>
                    @endif

                    {{--                users certificate --}}
                    @if(auth()->user()->role === 'leader')
                        @if(in_array($training->status, ['Completed', 'Expiring']) && $training->id)
                            <td>
                                @if($participant->signature && $participant->signature->signature_image)
                                    <a href="{{ route('certificates.participantCertificatePdf', $participant->id) }}" target="_blank"><i class="bi bi-download me-2"></i>Download</a>
                                @elseif($participant->signature && $participant->signature->signed_certificate_image)
                                    <a href="{{ uploads_url($participant->signature->signed_certificate_image) }}" target="_blank"><i class="bi bi-download me-2"></i>Download</a>
                                @else
                                    <span class="text-muted">Not signed yet</span>
                                @endif
                            </td>
                        @else
                            <td>-</td>
                        @endif
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="3">There are no users.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <x-elements.pagination :items="$trainingUsers"/>
</div>
