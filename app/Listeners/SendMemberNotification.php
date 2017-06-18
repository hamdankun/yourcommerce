<?php

namespace App\Listeners;

use Mail;
use App\Events\MemberCreated;
use App\Mail\MemberCreated as MemberMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMemberNotification implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  MemberCreated  $event
     * @return void
     */
    public function handle(MemberCreated $event)
    {
        Mail::to($event->credentials['email'])->send(new MemberMail($event->member));
    }
}
