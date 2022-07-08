<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendNewReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $reservation;
    private $client;
    private $room;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, Client $client, Room $room)
    {
        $this->reservation = $reservation;
        $this->client = $client;
        $this->room = $room;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('New reservation for') . ' ' . $this->client->firstname . ' ' . $this->client->lastname)
        ->markdown('emails.reservation.new', [
            'reservation' => $this->reservation,
            'client' => $this->client,
            'room' => $this->room
        ]);
    }
}
