<?php

namespace App\Mail\Proposal;

use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProposalMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Proposal */
    public $notifable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proposal $notifable)
    {
        $this->notifable = $notifable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.create_proposal')->to(config('app.email_admin'));
    }
}
