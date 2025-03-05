<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('lates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->dateTime('date_time_late');
            $table->text('information');
            $table->text('bukti')->nullable();
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('lates');
    }
};
