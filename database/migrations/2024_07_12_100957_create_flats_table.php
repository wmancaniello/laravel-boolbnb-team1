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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->smallInteger('max_guests');
            $table->smallInteger('rooms');
            $table->smallInteger('beds');
            $table->smallInteger('bathrooms');
            $table->mediumInteger('meters_square');
            $table->string('address');
            $table->string('address');
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->string('main_img');
            $table->string('visible');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
