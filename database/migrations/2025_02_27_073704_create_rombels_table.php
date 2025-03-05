<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('rombels', function (Blueprint $table) {
            $table->id();
            $table->string('rombel');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('rombels');
    }
};
