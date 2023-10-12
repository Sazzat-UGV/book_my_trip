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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('package_name');
            $table->string('package_period');
            $table->string('package_price');
            $table->string('start_from');
            $table->string('package_image')->default('default_package.jpg');
            $table->longText('package_details');
            $table->unsignedSmallInteger('package_rating')->nullable()->default(0);
            $table->date('starting_date');
            $table->date('ending_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
