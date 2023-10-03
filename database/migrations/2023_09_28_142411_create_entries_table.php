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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate');
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('vehicle_type');
            $table->timestamp('entry_time')->nullable();
            $table->integer('parking_spot_number')->nullable();
            $table->string('entry_status')->default('En tránsito');
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('rate_type')->default('Por hora');
            $table->decimal('current_rate', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
