<div>
    <div class="row mb-3 g-4">

        {{--    select all and clear btns --}}
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2 justify-content-start align-items-center">
                <button type="button" class="btn btn-outline-primary btn-sm" wire:click="clearAll">Clear</button>

                <span class="text-muted small">
                    {{ count($selected) }} selected
                </span>
            </div>
        </div>
    </div>

    <x-blocks.message />

{{--    the checkboxex with employee names and email --}}
    <div class="mb-4">
        @foreach($employees as $employee)
{{--            disable input checkbox once user selected the max amount of partiticpants number --}}
            <label class="d-flex py-3 mx-3 {{ count($selected) >= $maxParticipants && !in_array($employee->id, $selected) ? 'opacity-50' : '' }}">
                <div class="d-flex gap-3 align-items-center">
                    {{-- checkbox --}}
                    <input type="checkbox"
                           value="{{ $employee->id }}"
                           wire:model.live="selected"
                           class="form-check-input"
                           {{ count($selected) >= $maxParticipants && !in_array($employee->id, $selected) ? 'disabled' : '' }}>

                    {{-- name and email of the employee --}}
                    <div>
                        <h5 class="mb-1 ">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                        <p class="text-muted small mb-0">{{ $employee->email }}</p>
                    </div>
                </div>
            </label>
        @endforeach

        @foreach($selected as $id)
            <input type="hidden" name="user_ids[]" value="{{ $id }}">
        @endforeach
    </div>
</div>
