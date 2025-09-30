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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onUpdate('cascade')->onDelete('cascade');
            $table->string('code_forcem', 255);
            $table->integer('hours');
            $table->string('type', 255);
            $table->string('face_to_face/online', 255);
            $table->string('trainig_name', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
