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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('year_id')->constrained();
            $table->string('transaction_no'); 
            $table->integer('amount'); 
            $table->foreignId('discount_id')->nullable()->constrained();
            $table->float('discount_amount',15,2)->nullable(); 
            $table->text('payment_image')->nullable();
            $table->enum('status',['Draft','Pending','Payment Receive','Canceled'])->default('Draft');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
