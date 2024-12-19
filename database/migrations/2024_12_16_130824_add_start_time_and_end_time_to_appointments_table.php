<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->time('start_time')->after('appointment_date');
            $table->time('end_time')->after('start_time');
            $table->dropColumn('time_slot'); // Remove the old time_slot column
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('time_slot')->after('appointment_date');
            $table->dropColumn(['start_time', 'end_time']);
        });
    }
};
