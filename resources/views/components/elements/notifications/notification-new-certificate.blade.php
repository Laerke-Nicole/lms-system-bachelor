@if($notification->type === \App\Notifications\NewCertificate::class)
    @if(auth()->user()->role === 'leader')
        <div class="notification">
            <strong>Employee certificate earned</strong>

            <p>One of your employees has earned a certificate for {{ $notification->data['course_name'] }}!</p>

            <div class="d-flex gap-2">
                <div>
                    <a href="{{ route('trainings.show', $notification->data['training_id']) }}" class="btn btn-sm btn-primary">
                        View certificate
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

    @if(auth()->user()->role === 'user')
        <div class="notification">
            <strong>New Certificate</strong>

            <p>You have a new certificate for {{ $notification->data['course_name'] }}!</p>

            <p>You can find it in your profile page under "certificates" or in the trainings history under the action "view".</p>

            <x-blocks.form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    Mark as read
                </button>
            </x-blocks.form>
        </div>
    @endif
@endif
