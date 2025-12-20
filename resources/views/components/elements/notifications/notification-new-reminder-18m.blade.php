@if($notification->type === \App\Notifications\NewReminder18mPostTraining::class)
    <div class="notification">
        <strong>Its soon time to book a training again</strong>

        <p>Your training for {{ $notification->data['course_name'] }} is expiring in 6 months.</p>
        <p>Please book a new training soon.</p>

        <div class="d-flex gap-2">
            <div>
                <a href="{{ route('trainings.show', $notification->data['training_id']) }}" class="btn btn-sm btn-primary">
                    View training
                </a>
            </div>

            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    Mark as read
                </button>
            </form>
        </div>
    </div>
@endif
