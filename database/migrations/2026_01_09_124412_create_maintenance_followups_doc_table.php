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
        Schema::create('maintenance_followups_doc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_followup_id');
            $table->foreign('maintenance_followup_id')->references('id')->on('maintenance_followups')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('maintenance_followups_doc');
    }
};
