<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->unique(); // Reference to the appointment
            $table->decimal('total_amount', 10, 2); // Original service cost
            $table->decimal('discount_amount', 10, 2)->nullable(); // Discount applied
            $table->decimal('final_amount', 10, 2); // Final amount after discount
            $table->string('status')->default('pending'); // Payment status
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};