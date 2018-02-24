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

class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    /**
     * Create a new message instance.
     *
     * @param  User $order giving the Order Information to the Mail
     * @created by Demi
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @created by Demi
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendView');
    }
}
