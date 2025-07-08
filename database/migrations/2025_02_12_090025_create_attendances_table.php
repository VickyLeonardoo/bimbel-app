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
            $table->foreignId('children_id')->constrained();
            $table->foreignId('session_course_id')->constrained();
            $table->foreignId('enrollment_id')->constrained();
            $table->enum('status',['Present','Absent','Late','Leave'])->nullable();
            $table->foreignId('year_id')->constrained();
            $table->boolean('is_active')->default(true);
            $table->text('reason')->nullable();
            $table->string('grade');  
            $table->softDeletes();
            $table->timestamps();
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
