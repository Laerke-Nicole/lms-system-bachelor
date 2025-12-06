<div>
    <p class="text-dark mb-1 fs-4">Participants</p>
    @foreach($trainingUsers as $participant)
        <x-blocks.detail title="{{ $participant->user->first_name }} {{ $participant->user->last_name }}" col="col-md-6"/>
    @endforeach
</div>
