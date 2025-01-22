<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->text('map_iframe')->nullable(); // To store the Google Maps iframe
        });
    }

    public function down()
    {
        Schema::table('hospitals', function (Blueprint $table) {
            $table->dropColumn('map_iframe');
        });
    }
};
