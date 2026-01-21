<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hr_pending_issue_followup', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hr_pending_issues_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('followup_date');

            $table->foreignId('professional_id')->constrained('professionals');

            $table->text('description');

            $table->string('documents')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr_pending_issue_followups');
    }
};

