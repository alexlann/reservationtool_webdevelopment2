<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    private $client;
    private $question;
    private $fullPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client, $question, $fullPath)
    {
        $this->client = $client;
        $this->question = $question;
        $this->fullPath = $fullPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->client->firstname . ' ' . $this->client->lastname . ' ' . __('asked a question'))
        // ->attachFromStorage(public_path($this->fullPath)) // Unable to retrieve the mime_type for file at location: C:/Users/ann-s/sites/WebDevII/chateau-meiland/public/uploads/2022/04/24-Zw3hUhCgRj.png.
        ->markdown('emails.contact.new', [
            'client' => $this->client,
            'question' => $this->question
        ]);
    }
}
