@if(auth()->user()->role === 'admin')
    <div class="bg-light rounded-3 px-12">
        <div class="row py-4 bg-light">
            <div class="col-lg-4 d-flex align-items-center gap-4 mb-3 mb-lg-0">
                <i class="bi bi-journals fs-2"></i>
                <div>
                    <h2 class="mb-0">{{ $upcomingTrainingCount }}</h2>
                    <p class="mb-0 text-muted">Upcoming trainings</p>
                </div>
            </div>

            <div class="col-lg-4 d-flex align-items-center gap-4 mb-3 mb-lg-0">
                <i class="bi bi-mortarboard fs-2"></i>
                <div>
                    <h2 class="mb-0">{{ $completedTrainingCount }}</h2>
                    <p class="mb-0 text-muted">Completed trainings</p>
                </div>
            </div>

            <div class="col-lg-4 d-flex align-items-center gap-4">
                <i class="bi bi-box-seam fs-2"></i>
                <div>
                    <h2 class="mb-0">—</h2>
                    <p class="mb-0 text-muted">Status på træningspakker?</p>
                </div>
            </div>
        </div>
    </div>
@endif
