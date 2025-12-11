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
