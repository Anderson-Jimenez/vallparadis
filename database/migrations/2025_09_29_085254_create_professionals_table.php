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
        Schema::create('professionals',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('surnames', 255);
            $table->string('username', 255)->unique();
            $table->string('password');
            $table->string('phone_number', 20);
            $table->string('email_address',255)->unique();                                              
            $table->string('address', 255);
            $table->integer('number_locker');
            $table->string('clue_locker', 255);
            $table->string('link_status', 255);
            $table->string('status', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
