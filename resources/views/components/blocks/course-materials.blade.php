{{-- show preparation for trainigs that are upcoming --}}

@props(['training', 'tableHeaders'])


<tr>
    <td colspan="{{ count($this->tableHeaders) }}">
        <div class="p-3 bg-light rounded border">

            <strong class="mb-2 d-block">Course materials:</strong>

            @forelse ($training->trainingSlot->course->courseMaterials as $material)

                <div class="mb-2">
                    <span class="fw-bold">{{ $material->title }}</span>
                    <span class="text-muted">({{ $material->type }})</span>

                    <div>
                        @if($material->type === 'PDF' && $material->pdf)
                            <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank" class="text-primary">
                                View PDF
                            </a>
                        @else
                            <a href="{{ $material->url }}" target="_blank" class="text-primary">
                                Open Material
                            </a>
                        @endif
                    </div>
                </div>

            @empty
                <p class="text-muted">No course materials available.</p>
            @endforelse

        </div>
    </td>
</tr>
