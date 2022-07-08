<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::factory(100)->create();
        Client::factory(100)->create();
        Room::factory(20)->create();
    }
}
