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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('payment_method');
            $table->decimal('amount');
            $table->string('currency', 3)->default('BDT');
            $table->timestamp('paid_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['Pending', 'Completed', 'Failed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
