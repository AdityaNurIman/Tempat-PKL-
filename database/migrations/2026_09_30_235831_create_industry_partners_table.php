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
        Schema::create('industry_partners', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('industry_sector');
            $table->string('city');
            $table->string('address');
            $table->string('vocational_majors'); // Comma-separated or JSON: RPL, TKJ, DMM, etc.
            $table->integer('total_quota')->default(5);
            $table->integer('filled_quota')->default(0);
            $table->string('allowance')->nullable();
            $table->string('duration')->default('3 Bulan');
            $table->text('requirements');
            $table->text('job_description');
            $table->string('mentor_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industry_partners');
    }
};
