<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use SerializesModels;

    /**
     * Order created
     * @var \App\Models\Sales\Order
     */
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@yourcommerce.com')
                  ->subject('Order Notification')
                  ->markdown('emails.orders.created')
                  ->with([
                    'order' => $this->order
                  ]);
    }
}
