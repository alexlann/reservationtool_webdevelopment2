<?php

namespace App\Http\Controllers;

use App\Mail\sendContactFormMail;
use App\Models\Client;
use App\Models\Address;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    //
    public function index() {
        $clients = Client::OrderBy('updated_at', 'DESC')->get();

        // return view
        return view('clients', ["clients" => $clients]);
    }

    public function create($client_id = null) {
        // if updating client, show old data
        if($client_id) {
            $client = Client::where('id', $client_id)->firstOrFail();
            $address = Address::where('id', $client->address_id)->firstOrFail();
        } else {
            $client = null;
            $address = null;
        }

        // return view
        return view('createClient', [
            "client" => $client,
            "address" => $address,
        ]);
    }

    public function store(Request $r) {
        // validate request
        $r->validate([
            'title' => 'required',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'street' => 'required|max:255',
            'zipcode' => 'required|numeric',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'country_code' => 'required|max:2|string',
            'email' => 'required|unique:clients,email|email|max:255',
        ]);

        // add to database
        $address = new Address();
        $address->street = $r->street;
        $address->zipcode = $r->zipcode;
        $address->city = $r->city;
        $address->province = $r->province;
        $address->country_code = $r->country_code;
        $address->save();

        $client = new Client();
        $client->address_id = $address->id;
        $client->title = $r->title;
        $client->firstname = $r->firstname;
        $client->lastname = $r->lastname;
        $client->email = $r->email;
        $client->save();

        return redirect("/clients")->with('status', __('Client added'));;
    }

    public function update(Request $r) {
        // validate request
        $r->validate([
            'id' => 'required',
            'title' => 'required',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'street' => 'required|max:255',
            'zipcode' => 'required|numeric',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'country_code' => 'required|max:2|string',
            'email' => 'required|email|max:255',
        ]);

        $client = Client::where('id', $r->id)->firstOrFail();

        // add to database
        $client = Client::findOrFail($r->id);
        $client->title = $r->title;
        $client->firstname = $r->firstname;
        $client->lastname = $r->lastname;
        $client->email = $r->email;
        $client->save();

        $address = Address::findOrFail($client->address_id);
        $address->street = $r->street;
        $address->zipcode = $r->zipcode;
        $address->city = $r->city;
        $address->province = $r->province;
        $address->country_code = $r->country_code;
        $address->save();

        return redirect("/clients")->with('status', __('Client updated'));;
    }

    public function destroy($client_id) {
        // delete reservation with matching client
        Reservation::where('client_id', $client_id)->delete();
        // delete client
        Client::find($client_id)->delete();

        return redirect("/clients")->with('status-warning', __('Client deleted'));
    }

    public function contact(Request $r) {
        // validate request
        $r->validate([
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'email' => 'required|max:255|email',
        'question' => 'required|max:255',
        'file' => 'file|max:1000|mimes:png,jpg,gif,bmp,pdf,doc'
        ]);

        if($r->file) {
            // get extension
            $ext = $r->file->getClientOriginalExtension();

            // make random file name, with day-prefix
            $randomName = date('d') . '-' . Str::random(10) . '.' . $ext;

            // path magic
            $filePath = 'uploads/' . date('Y/m/');
            $fullPath = $filePath . $randomName;

            // upload files in symbolic public folder (make accessable)
            /** @var Illuminate\Filesystem\FilesystemAdapter */
            $fileSystem = Storage::disk('public');
            $fileSystem->putFileAs($filePath, $r->file, $randomName);
        } else {
            $fullPath = null;
        }


        $client = new Client();
        $client->firstname = $r->firstname;
        $client->lastname = $r->lastname;
        $client->email = $r->email;
        $question = $r->question;

        $userEmail = User::firstOrFail();
        Mail::to($userEmail)->send(new sendContactFormMail($client, $question, $fullPath));

        // redirect
        return redirect("/home")->with('status', __('Question send!'));
    }
}
