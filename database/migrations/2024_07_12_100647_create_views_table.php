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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flat_id')->nullable()->after('id');
            $table->date('date');
            $table->string('ip_address');
            $table->timestamps();
            // foreign key
            $table->foreign('flat_id')->references('id')->on('flats')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
