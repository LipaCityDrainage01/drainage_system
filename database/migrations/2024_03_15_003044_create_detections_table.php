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
        Schema::create('detections', function (Blueprint $table) {
            $table->id();
            $table->json('sensor_data')->nullable();
            $table->string('sensor_1')->default(0);
            $table->string('sensor_2')->default(0);
            $table->string('sensor_3')->default(0);
            $table->string('sensor_4')->default(0);
            $table->string('status')->default('Pending');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detections');
    }
};
