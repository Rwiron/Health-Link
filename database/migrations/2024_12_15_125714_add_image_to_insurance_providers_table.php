<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('insurance_providers', function (Blueprint $table) {
            $table->string('image')->nullable()->after('hospital_id'); // Add image column
        });
    }

    public function down()
    {
        Schema::table('insurance_providers', function (Blueprint $table) {
            $table->dropColumn('image'); // Drop the image column if rolled back
        });
    }
};
