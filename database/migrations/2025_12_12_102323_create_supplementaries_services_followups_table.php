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
        Schema::create('supplementaries_services_followups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplementaries_service_id');
            $table->foreign('supplementaries_service_id', 'ssf_service_id')->references('id')->on('supplementaries_services')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date');
            $table->text('issue');
            $table->string('comment',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplementaries_services_followups');
    }
};
