<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('doctor_service', function (Blueprint $table) {
            $table->text('description')->nullable(); // Add description
            $table->boolean('status')->default(true); // Add status (available or not)
            $table->decimal('appointment_fees', 10, 2)->nullable(); // Add appointment fees
        });
    }

    public function down()
    {
        Schema::table('doctor_service', function (Blueprint $table) {
            $table->dropColumn(['description', 'status', 'appointment_fees']);
        });
    }
};