<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Airline;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('from')->default('');
            $table->string('to')->default('');
            $table->foreignIdFor(Airline::class)->constrained()->restrictOnDelete();
            $table->string('flight_number')->default('');
            $table->dateTime('departure_date')->nullable();
            $table->dateTime('arrival_date')->nullable();
            $table->string('gate')->default('N/A');
            $table->integer('seating')->default(0)->unsigned()->comment('max seating capacity');
            $table->time('flight_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }

};
