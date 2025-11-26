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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id');
            $table->foreignId('driver_id')->nullable();
            $table->decimal('pickup_lat',10,6);
            $table->decimal('pickup_lng',10,6);
            $table->decimal('dest_lat',10,6);
            $table->decimal('dest_lng',10,6);
            $table->enum('status', [
                'pending', 'driver_requested','driver_approved','in_progress','completed_by_passenger','completed_by_driver','completed'
            ])->default('pending');
            $table->boolean('passenger_completed')->default(false);
            $table->boolean('driver_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rides');
    }
};
