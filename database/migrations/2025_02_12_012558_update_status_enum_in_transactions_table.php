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
        Schema::table('transactions', function (Blueprint $table) {
            \DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('Draft', 'Pending', 'Payment Receive', 'Cancelled') DEFAULT 'Draft'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            \DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('Draft', 'Pending', 'Payment Receive', 'Canceled') DEFAULT 'Draft'");
        });
    }
};
