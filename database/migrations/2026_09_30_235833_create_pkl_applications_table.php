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
        Schema::create('pkl_applications', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('industry_partner_id')->constrained('industry_partners')->onDelete('cascade');
            $table->string('student_name');
            $table->string('nisn');
            $table->string('school_name');
            $table->string('major');
            $table->string('whatsapp_number');
            $table->string('guardian_teacher_name')->nullable();
            $table->string('internship_period')->default('3 Bulan (Januari - Maret)');
            $table->string('portfolio_url')->nullable();
            $table->string('status')->default('review_school'); // review_school, accepted, rejected
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkl_applications');
    }
};
