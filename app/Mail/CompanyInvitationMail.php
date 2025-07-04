<?php

namespace App\Mail;

use App\Models\CompanyInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(CompanyInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        $invitationLink = route('register.invited', ['token' => $this->invitation->token]);


        return $this->subject('Invitație la companie')
            ->view('emails.invitation')
            ->with([
                'invitationLink' => $invitationLink,
            ]);
    }
}
