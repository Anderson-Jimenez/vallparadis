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
        Schema::create('accidents_doc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accident_id');
            $table->foreign('accident_id')->references('id')->on('accidents')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name',255);
            $table->string('path',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents_doc');
    }
};
