<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberCreated extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Member data
     * @var \App\Models\Master\Member;
     */
    protected $member;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('no-reply@yourcommerce.com')
                ->subject('Member Notification')
                ->markdown('emails.member.created')
                ->with([
                  'member' => $this->member
                ]);
    }
}
