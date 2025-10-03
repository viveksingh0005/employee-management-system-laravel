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
        Schema::create('salaries', function (Blueprint $table) {
    $table->id();
    $table->foreignId('employee_id')->constrained()->onDelete('cascade');
    $table->decimal('base_salary', 10, 2);        
    $table->integer('extra_duties')->default(0);  
    $table->decimal('extra_duty_salary', 10, 2)->default(0.00); 
    $table->decimal('deductions', 10, 2)->default(0.00); 
    $table->integer('leaves')->default(0);        
    $table->decimal('leave_deduction', 10, 2)->default(0.00); 
    $table->decimal('net_salary', 10, 2)->default(0.00); 
    $table->string('month');  // "2025-10"
    $table->date('payment_date')->nullable();
    $table->enum('status', ['pending','paid'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
