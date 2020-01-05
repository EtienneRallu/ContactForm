<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
Use App\Message;

class NewMessage extends Mailable
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
        return $this->from($this->message->email, $this->message->firstName . ' '. $this->message->lastName )
            ->subject($this->message->subject)
            ->view('NewMessage')->with([
                'content' => $this->message->content,
                'firstName' => $this->message->firstName,
                'lastName' => $this->message->lastName,
                'phoneNumber' => $this->message->phoneNumber,
                'email' => $this->message->email,
            ]);

    }
}