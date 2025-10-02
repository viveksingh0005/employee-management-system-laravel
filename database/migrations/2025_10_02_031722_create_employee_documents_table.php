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
    Schema::create('employee_documents', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->string('document_name'); // e.g. "Resume", "Experience Certificate"
        $table->string('document_file'); // file path
        $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_documents');
    }
};
