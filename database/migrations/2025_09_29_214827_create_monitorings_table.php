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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('professional_id');
            $table->unsignedBigInteger('professional_monitoring_id');
            $table->foreign('professional_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('professional_monitoring_id')->references('id')->on('professionals')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type',255);
            $table->date('date');
            $table->text('issue');
            $table->text('comments');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
