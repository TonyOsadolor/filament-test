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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('id');
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('dept')->nullable();
            $table->year('entry_year')->nullable();
            $table->year('graduation_year')->nullable();
            $table->date('approval_date')->nullable();
            $table->boolean('passed_final_exam')->default(false);
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
