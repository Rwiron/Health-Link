<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('insurance_id')->nullable()->after('hospital_id');
            $table->foreign('insurance_id')->references('id')->on('insurance_providers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['insurance_id']);
            $table->dropColumn('insurance_id');
        });
    }
};
