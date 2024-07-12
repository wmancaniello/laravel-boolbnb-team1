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
        Schema::create('flat_service', function (Blueprint $table) {
            $table->unsignedBigInteger('flat_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();
            
            $table->foreign('flat_id')->references('id')->on('flats')->cascadeOnDelete();
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete();
            $table->primary(['flat_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flat_service');
    }
};
