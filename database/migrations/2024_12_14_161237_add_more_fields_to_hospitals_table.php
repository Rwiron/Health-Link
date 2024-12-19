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
            $table->string('organization_type')->nullable(); // Type of organization (e.g., Private, Public, Mixture)
            $table->string('logo')->nullable(); // Path to the hospital logo
            $table->string('location')->nullable(); // Google Map location (lat, long or address)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn(['organization_type', 'logo', 'location']);
        });
    }
};
