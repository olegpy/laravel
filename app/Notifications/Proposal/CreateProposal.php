<?php

namespace App\Notifications\Proposal;

use App\Mail\Proposal\CreateProposalMail;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateProposal extends Notification implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue;

    /** @var string */
    public $emailAdmin;

    /**
     * @param string $emailAdmin
     */
    public function __construct(string $emailAdmin)
    {
        $this->emailAdmin = $emailAdmin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  Proposal  $notifiable
     * @return CreateProposalMail
     */
    public function toMail(Proposal $notifiable): CreateProposalMail
    {
        return (new CreateProposalMail($notifiable));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
