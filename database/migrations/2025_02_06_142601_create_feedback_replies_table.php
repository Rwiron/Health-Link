<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('feedback_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id')->constrained()->onDelete('cascade');
            $table->string('sender'); // 'admin' or 'user'
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback_replies');
    }
};
