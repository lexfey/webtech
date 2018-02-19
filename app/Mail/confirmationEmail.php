<?php
/**
 * Create by Demi
 *
 *
 */
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Order;

class confirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;

    public function __construct(Order $order)
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
        return $this->view('email.sendOrderMail');
    }
}
