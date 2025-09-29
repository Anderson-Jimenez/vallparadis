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
        Schema::create('accident', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_professional');
            $table->foreign('id_professional')->references('id')->on('professional')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type',255);
            $table->date('date');
            $table->string('context',255);
            $table->text('description');
            $table->string('duration',255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accident');
    }
};
