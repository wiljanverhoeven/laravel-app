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
        Schema::create('return_bus_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');
            $table->string('departure_location')->comment('Festival location');
            $table->string('arrival_location')->comment('Drop-off location');
            $table->text('arrival_address');
            $table->dateTime('departure_date')->comment('Leaving festival');
            $table->dateTime('arrival_date')->comment('Arriving at drop-off');
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_bus_routes');
    }
};
