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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->enum('loan_type', ['Emergency', 'Development', 'Business', 'Education']);
            $table->decimal('amount', 15, 2);
            $table->integer('repayment_period');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();
            
            $table->index('member_id');
            $table->index('status');
            $table->index('loan_type');
            $table->index('amount');
            $table->index('created_at');
            
            $table->check('amount > 0');
            $table->check('repayment_period > 0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
