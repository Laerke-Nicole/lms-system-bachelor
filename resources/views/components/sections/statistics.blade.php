<div class="mb-5 d-flex flex-column gap-2">
        <div class="col-12 d-flex align-items-center gap-4 px-12">
            <i class="bi bi-hourglass-split fs-2"></i>
            <div>
                <h2 class="mb-0">{{ $pendingTrainingCount }}</h2>
                <p class="mb-0 text-muted">Pending trainings</p>
            </div>
        </div>
    <hr>

        <div class="col-12 d-flex align-items-center gap-4 px-12">
            <i class="bi bi-journals fs-2"></i>
            <div>
                <h2 class="mb-0">{{ $upcomingTrainingCount }}</h2>
                <p class="mb-0 text-muted">Upcoming trainings</p>
            </div>
        </div>
    <hr>

        <div class="col-12 d-flex align-items-center gap-4 px-12">
            <i class="bi bi-mortarboard fs-2"></i>
            <div>
                <h2 class="mb-0">{{ $completedTrainingCount }}</h2>
                <p class="mb-0 text-muted">Completed trainings</p>
            </div>
        </div>
    <hr>
</div>
