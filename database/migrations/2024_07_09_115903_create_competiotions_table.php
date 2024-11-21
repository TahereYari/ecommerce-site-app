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
        Schema::create('competiotions', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(false);
            $table->text('number');
            $table->text('description')->nullable(false);
            $table->boolean('deleteStatuse')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competiotions');
    }
};
