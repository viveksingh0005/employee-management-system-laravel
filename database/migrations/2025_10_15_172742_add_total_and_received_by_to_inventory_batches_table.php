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
    Schema::table('inventory_batches', function (Blueprint $table) {
        $table->decimal('total', 12, 2)->default(0);
        $table->foreignId('received_by')->nullable()->constrained('employees')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('inventory_batches', function (Blueprint $table) {
        $table->dropForeign(['received_by']);
        $table->dropColumn(['total', 'received_by']);
    });
}
};
