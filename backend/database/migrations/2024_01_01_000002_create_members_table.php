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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('microfinance_id')->constrained()->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('id_number', 20)->unique();
            $table->string('phone', 20);
            $table->string('email', 255);
            $table->text('address');
            $table->enum('status', ['Pending', 'Active'])->default('Pending');
            $table->timestamps();
            
            $table->index('microfinance_id');
            $table->index('status');
            $table->index('id_number');
            $table->index(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
