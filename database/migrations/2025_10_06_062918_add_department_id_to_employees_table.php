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
    Schema::table('employees', function (Blueprint $table) {
        // Remove the old string column
        $table->dropColumn('department');

        // Add foreign key column
        $table->foreignId('department_id')
              ->nullable()
              ->constrained()
              ->onDelete('set null'); // if department deleted, set null
    });
}

public function down(): void
{
    Schema::table('employees', function (Blueprint $table) {
        $table->string('department')->nullable();
        $table->dropForeign(['department_id']);
        $table->dropColumn('department_id');
    });
}

};
