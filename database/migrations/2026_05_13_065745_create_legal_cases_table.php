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
        Schema::create('legal_cases', function (Blueprint $table) {
    $table->id();

    $table->foreignId('client_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('assigned_lawyer_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->string('case_title');
    $table->string('case_reference')->unique();
    $table->string('case_type');
    $table->string('case_status')->default('Open');

    $table->date('next_important_date')->nullable();
    $table->text('latest_client_update')->nullable();
    $table->text('internal_notes')->nullable();

    $table->date('opened_date')->nullable();
    $table->date('closed_date')->nullable();
    $table->string('archive_location')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_cases');
    }
};
