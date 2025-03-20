<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 50);
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'successful', 'failed', 'refunded']);
            $table->timestamp('payment_date');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
