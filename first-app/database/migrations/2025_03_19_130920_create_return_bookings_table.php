<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('return_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('return_bus_route_id')->constrained()->onDelete('cascade');
            $table->integer('number_of_seats')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('return_bookings');
    }
};
