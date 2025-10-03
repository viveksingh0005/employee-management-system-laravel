<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->date('dob');
        $table->string('email')->unique();
        $table->string('department');
        $table->string('photo')->nullable(); // profile photo path
        $table->string('aadhaar_card')->nullable();
        $table->string('pan_card')->nullable();
        $table->string('account_number')->nullable();
        $table->string('role'); // e.g. HR, Admin, Employee
         $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
