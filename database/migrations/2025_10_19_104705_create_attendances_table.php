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
        Schema::create('attendances', function (Blueprint $table) {
    $table->id();
    $table->foreignId('employee_id')->constrained()->onDelete('cascade');
    $table->date('date');
    $table->enum('morning_shift', ['none', 'half', 'full'])->default('none');
    $table->enum('evening_shift', ['none', 'half', 'full'])->default('none');
    $table->timestamps();

    $table->unique(['employee_id', 'date']); // prevent duplicate entry
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
