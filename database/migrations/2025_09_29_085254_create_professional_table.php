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
        Schema::create('professional',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name',255);
            $table->string('surnames',255);
            $table->string('phone_number', 20);
            $table->string('email_address',255);
            $table->string('address',255);
            $table->integer('number_locker');
            $table->integer('clue_locker');
            $table->string('link_status',255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional');
    }
};
