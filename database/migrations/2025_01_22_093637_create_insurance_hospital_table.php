<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceHospitalTable extends Migration
{
    public function up()
    {
        Schema::create('insurance_hospital', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('insurance_id');
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('insurance_id')->references('id')->on('insurance_providers')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insurance_hospital');
    }
}
