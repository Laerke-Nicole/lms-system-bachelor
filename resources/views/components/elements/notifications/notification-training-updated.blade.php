@if($notification->type === \App\Notifications\TrainingUpdated::class)
    <div class="notification">
        <strong>Training updated</strong>

        <p>
            A training for
            {{ $notification->data['course_name'] }}
            has been updated by {{ $notification->data['updater_name'] }}.
        </p>

        <div class="d-flex gap-2">
            <div>
                <a href="{{ route('trainings.show', $notification->data['training_id']) }}" class="btn btn-sm btn-primary">
                    View training
                </a>
            </div>

            <x-blocks.form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    Mark as read
                </button>
            </x-blocks.form>
        </div>
    </div>
@endif
