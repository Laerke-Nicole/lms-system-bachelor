@props(['participantId'])

<form action="{{ route('trainings.upload-assessment', $participantId) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <input
            type="file"
            name="assessment"
            class="form-control"
            accept=".jpg,.jpeg,.png,.pdf"
            required
        />
        @error('assessment')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
