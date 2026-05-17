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
    Schema::create('legal_case_staff', function (Blueprint $table) {
        $table->id();

        $table->foreignId('legal_case_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('staff_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->timestamps();

        $table->unique(['legal_case_id', 'staff_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_case_staff');
    }
};
