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
        Schema::create('external_contact', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_center');
            $table->foreign('id_center')->references('id')->on('center')->onUpdate('cascade')->onDelete('cascade'); 

            $table->string('type',255);
            $table->string('cause/service',255);
            $table->string('company/department',255);
            $table->string('manager',255);
            $table->string('phone_numer',20);
            $table->string('email_address',50);
            $table->text('comments');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_contact');
    }
};
