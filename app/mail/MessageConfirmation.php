<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
Use App\Message;

class MessageConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Message
     */
    public $message;

    /**
     * MessageConfirmation constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no_reply@etiennerallu.com', 'Etienne Rallu')
            ->subject('Thanks for your message')
            ->view('MessageConfirmation')->with([
                'subject' => $this->message->subject,
                'content' => $this->message->content,
            ]);

    }
}