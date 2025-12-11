@props(['participant', 'participantId'])

{{--upload the assessment--}}
@if(!$participant->assessment)
    <x-blocks.form action="{{ route('assessments.upload', $participantId) }}" method="POST" enctype="multipart/form-data">

        <div class="d-flex gap-2 align-items-start flex-wrap">
            <input
                type="file"
                name="assessment"
                class="form-control w-60"
                accept=".jpg,.jpeg,.png,.pdf"
                required
            />

            <button type="submit" class="btn btn-primary">Upload assessment</button>
        </div>

    </x-blocks.form>
@endif


{{--download the assessment--}}
@if($participant->assessment)
    <a href="{{ asset('storage/' . $participant->assessment) }}" download><i class="bi bi-download fs-4 me-2"></i>Download</a>
@endif

{{--delete btn to delete the assessment--}}
@if($participant->assessment)
    <x-blocks.form action="{{ route('trainings.assessment.destroy', $participantId) }}" method="POST" enctype="multipart/form-data">
        @method('DELETE')

        <button type="submit" class="btn p-0 pt-3 d-flex align-items-center" href="{{ route('trainings.show', $participantId) }}" onclick="return confirm('Delete the assessment image?')"><i class="bi bi-trash fs-4 me-2"></i>Delete</button>
    </x-blocks.form>
@endif
