<x-blocks.form action="{{ route('trainings.assessment.destroy', $participantId) }}" method="POST" enctype="multipart/form-data">
    @method('DELETE')

    <button type="submit" class="btn p-0 pt-3 d-flex align-items-center" href="{{ route('trainings.show', $participantId) }}" onclick="return confirm('Delete the assessment image?')"><i class="bi bi-trash fs-4 me-2"></i>Delete</button>
</x-blocks.form>
