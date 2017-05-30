<?php

namespace App\Listeners;

use Mail;
use App\Events\OrderCreated;
use App\Mail\OrderCreated as OrderMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreatedNotification implements ShouldQueue
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
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
      Mail::to($event->order->member)->send(new OrderMail($event->order));
    }

    /**
     * Failed listeners
     * @param  App\Events\OrderCreated $event
     * @param  \Exception       $exception
     * @return void
     */
    public function failed(OrderCreated $event, $exception)
    {
        //
    }
}
