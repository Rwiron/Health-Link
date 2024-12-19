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
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable(); // For profile image
            $table->string('district')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['image', 'district', 'sector', 'cell', 'province', 'country']);
        });
    }
};
