<?php

namespace App\Http\Controllers;

use App\Mail\sendNewReservationMail;
use App\Models\Reservation;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    //
    public function index() {
        // show all relevant reservations
        $reservations = Reservation::OrderBy('date_start', 'ASC')->where('date_end', '>=', now())->get();

        foreach ($reservations as $reservation) {
            // add firstname, lastname and roomname to reservation
            $reservation->setAttribute('firstname', Client::select('firstname')
                                             ->where('id', $reservation->client_id)
                                             ->firstOrFail()
                                             ->firstname
                                            );
            $reservation->setAttribute('lastname', Client::select('lastname')
                                             ->where('id', $reservation->client_id)
                                             ->firstOrFail()
                                             ->lastname
                                            );
            $reservation->setAttribute('room_name', Room::select('name')
                                             ->where('id', $reservation->room_id)
                                             ->firstOrFail()
                                             ->name
                                            );
            // change date format
            $reservation->date_start = date('d/m/Y', strtotime($reservation->date_start));
            $reservation->date_end = date('d/m/Y', strtotime($reservation->date_end));

        }

        // return view
        return view('reservations', [
            "reservations" => $reservations,
        ]);
    }

    public function create($client_id, $reservation_id = null) {
        $client = Client::where('id', $client_id)->firstOrFail();
        $rooms = Room::get();

        if($reservation_id) {
            $reservation = Reservation::where('id', $reservation_id)->firstOrFail();
            $reservation->date_start_ymd = date('Y-m-d', strtotime($reservation->date_start));
            $reservation->date_end_ymd = date('Y-m-d', strtotime($reservation->date_end));
        } else {
            $reservation = null;
        }

        // check if available
        if(isset($_GET['date_start']) && isset($_GET['date_end'])) {
            $date_start = $_GET['date_start'];
            $date_end = $_GET['date_end'];
            $unavailableRooms = Reservation::select('room_id')
                ->whereDate('date_start', '>=', $date_start)
                ->whereDate('date_start', '<=', $date_end)
                ->whereDate('date_end', '>=', $date_start)
                ->whereDate('date_end', '<=', $date_end)
                ->get();
            $unavailableRoomsArray = $unavailableRooms->map(function($unavailableRoom) {
                return $unavailableRoom->room_id;
            })->toArray();
        } else {
            $unavailableRoomsArray = [];
        }

        // return view
        return view('createReservation', [
            "client" => $client,
            "rooms" => $rooms,
            "unavailableRooms" => $unavailableRoomsArray,
            "reservation" => $reservation,
        ]);
    }

    public function store(Request $r) {
        // validate request
        $r->validate([
            'user_id' => 'required',
            'client_id' => 'required',
            'room_id' => 'required',
            'date_start' => 'required|after:yesterday',
            'date_end' => 'required|after:yesterday|after:date_start',
        ]);

        // add to database
        $reservation = new Reservation();
        $reservation->user_id = $r->user_id;
        $reservation->client_id = $r->client_id;
        $reservation->room_id = $r->room_id;
        $reservation->date_start = $r->date_start;
        $reservation->date_end = $r->date_end;
        $reservation->save();


        $client = Client::where('id', $reservation->client_id)->firstOrFail();
        $room = Room::where('id', $reservation->room_id)->firstOrFail();

        $userEmail = Auth::user()->email;
        Mail::to($userEmail)->send(new sendNewReservationMail($reservation, $client, $room));

        // redirect
        return redirect("/reservations")->with('status', __('Reservation added'));
    }

    public function update(Request $r, $reservation_id) {
        // security validation
        $reservation = Reservation::where('id', $reservation_id)->firstOrFail();

        // validate
        $r->validate([
            'user_id' => 'required',
            'room_id' => 'required',
            'client_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);


        // add to database
        $reservation = Reservation::findOrFail($reservation_id);
        $reservation->user_id = $r->user_id;
        $reservation->client_id = $r->client_id;
        $reservation->room_id = $r->room_id;
        $reservation->date_start = $r->date_start;
        $reservation->date_end = $r->date_end;
        $reservation->save();

        return redirect("/reservations")->with('status', __('Reservation updated'));
    }

    public function destroy($reservation_id) {
        Reservation::find($reservation_id)->delete();

        return redirect()->back()->with('status-warning', __('Reservation deleted'));
    }
}
