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
        Schema::create('bus_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');
            $table->string('departure_location');
            $table->text('departure_address');
            $table->string('departure_coordinates', 50)->nullable()->comment('Latitude,Longitude');
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
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
        Schema::dropIfExists('bus_routes');
    }
};
