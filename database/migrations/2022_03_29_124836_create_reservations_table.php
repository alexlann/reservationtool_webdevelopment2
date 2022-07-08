<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            //foreign keys
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->text('remarks')
                ->nullable()
                ->default(NULL);

            // reservation fields
            $table->float('price')
                ->nullable()
                ->default(NULL);
            $table->dateTime('date_start');
            $table->dateTime('date_end');

            //timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
