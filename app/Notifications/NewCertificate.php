<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCertificate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $course_name, public int $certificate_recipient_id, public int $training_id)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // if the user is a leader and its one of their employees that got a certificate
        if ($notifiable->role === 'leader' && $notifiable->id !== $this->certificate_recipient_id) {
            return (new MailMessage)
                ->subject('Employee certificate earned')
                ->line("One of your employees has earned a certificate for {$this->course_name}!")
                ->action('View certificate', route('trainings.show', $this->training_id));
        }

        // mail for the user that got the certificate
        return (new MailMessage)
            ->subject('New Certificate')
            ->line('You have a new certificate for ' . $this->course_name . '!')
            ->line('You can find it in your profile page under "certificates" or in the trainings history under the action "view".');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'course_name' => $this->course_name,
            'certificate_recipient_id' => $this->certificate_recipient_id,
            'training_id' => $this->training_id,
        ];
    }
}
