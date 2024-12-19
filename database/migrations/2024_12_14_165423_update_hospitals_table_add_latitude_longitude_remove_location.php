<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn('location'); // Remove the 'location' column
            $table->decimal('latitude', 10, 8)->nullable(); // Add 'latitude' column
            $table->decimal('longitude', 11, 8)->nullable(); // Add 'longitude' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->string('location')->nullable(); // Re-add the 'location' column
            $table->dropColumn('latitude'); // Remove the 'latitude' column
            $table->dropColumn('longitude'); // Remove the 'longitude' column
        });
    }
};
