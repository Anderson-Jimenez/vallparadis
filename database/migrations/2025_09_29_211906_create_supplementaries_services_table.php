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
        Schema::create('supplementaries_services', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('cascade')->onDelete('cascade'); 
            $table->string('type',255);
            $table->date('start_date');
            $table->string('manager',255);
            $table->string('email_address',255);
            $table->string('phone_number',20);
            $table->text('comments');          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplementaries_services');
    }
};
