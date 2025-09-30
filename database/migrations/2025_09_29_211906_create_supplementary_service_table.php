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
        Schema::create('supplementary_service', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onUpdate('cascade')->onDelete('cascade'); 
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
        Schema::dropIfExists('supplementary_service');
    }
};
