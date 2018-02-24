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


    public $order;
    /**
     * Create a new message instance.
     *
     * @param  Order $order giving the Order Information to the Mail
     * @created by Alex
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    /**
     * Build the message.
     *
     * @created by Alex
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendOrderMail');
    }
}
