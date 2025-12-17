<div>
    <div class="row booking-section-small-always g-4">
        <div class="col-sm-5 col-md-6 col-lg-4">
            <div class="input-group flex-nowrap">
                    <span class="input-group-text border-end-0" id="addon-wrapping">
                        <i class="bi bi-search"></i>
                    </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Search employees" aria-label="Username" aria-describedby="addon-wrapping" id="employeeSearch">
            </div>
        </div>

        {{--    select all and clear btns --}}
        <div class="col-sm-7 col-md-6 col-lg-8">
            <div class="d-flex flex-wrap gap-2 justify-content-end align-items-center">
                <button type="button" class="btn btn-outline-primary btn-sm" wire:click="clearAll">Clear</button>

                <span class="text-muted small">
                    {{ count($selected) }} selected
                </span>
            </div>
        </div>
    </div>

    <x-blocks.error-alert />

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
