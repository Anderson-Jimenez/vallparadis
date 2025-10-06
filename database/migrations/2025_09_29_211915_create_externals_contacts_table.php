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
        Schema::create('externals_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers')->onUpdate('cascade')->onDelete('cascade'); 

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
        Schema::dropIfExists('externals_contacts');
    }
};
