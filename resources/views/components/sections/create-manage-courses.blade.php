<div class="row mb-5 g-4">

{{--    create new course --}}
    <div class="col-lg-6">
        <a href="{{ route('courses.create') }}" class="text-decoration-none text-dark">
            <div class="card border-0 h-100 p-4 bg-white">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <p class="text-muted mb-1 text-label-1">New course and training details</p>
                        <h3 class="mb-0">Create new course</h3>
                    </div>
                    <i class="bi bi-arrow-right-circle-fill fs-2 text-primary"></i>
                </div>
            </div>
        </a>
    </div>

{{--    manage courses --}}
    <div class="col-lg-6">
        <a href="{{ route('courses.index') }}" class="text-decoration-none text-dark">
            <div class="card border-0 h-100 p-4 bg-white">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <p class="text-muted mb-1 text-label-1">Edit and update existing courses</p>
                        <h3 class="mb-0">Manage courses</h3>
                    </div>
                    <i class="bi bi-arrow-right-circle-fill fs-2 text-primary"></i>
                </div>
            </div>
        </a>
    </div>

</div>
