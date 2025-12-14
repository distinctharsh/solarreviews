<?php

namespace App\Notifications;

use App\Models\UserProfileSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProfileSubmissionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected UserProfileSubmission $submission
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('admin.profile-submissions.show', $this->submission);

        return (new MailMessage)
            ->subject('New profile submission pending review')
            ->greeting('Hi ' . ($notifiable->name ?? 'Admin') . ',')
            ->line(sprintf(
                '%s just submitted the %s intake form.',
                $this->submission->user?->name ?? 'A user',
                ucfirst($this->submission->form_type)
            ))
            ->line('Please review the submission to approve or request changes.')
            ->action('Review submission', $url)
            ->line('Thank you for keeping the marketplace vetted!');
    }
}
