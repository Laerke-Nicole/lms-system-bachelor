@if($notification->type === \App\Notifications\NewTraining::class)
    <div class="notification">
        <strong>You have a new booked training</strong>

        <p>
            A training for
            {{ $notification->data['course_name'] }}
            has been booked
            {{ $notification->data['training_date'] }}.
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
