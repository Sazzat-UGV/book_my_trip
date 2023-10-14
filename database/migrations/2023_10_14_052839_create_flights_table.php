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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airlines_name');
            $table->string('airlines_model');
            $table->time('departure_time');
            $table->string('price');
            $table->string('from');
            $table->string('to');
            $table->date('flight_date');
            $table->unsignedBigInteger('total_sit');
            $table->unsignedBigInteger('available_sit');
            $table->boolean('is_active')->default(true);
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
