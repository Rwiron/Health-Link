<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Patient/User ID
            $table->foreignId('hospital_id')->constrained('hospitals')->onDelete('cascade'); // Hospital ID
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade'); // Doctor ID
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Service ID
            $table->foreignId('insurance_id')->nullable()->constrained('insurance_providers')->nullOnDelete(); // Insurance ID (fixed table name)
            $table->date('booking_date'); // Date of appointment
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
