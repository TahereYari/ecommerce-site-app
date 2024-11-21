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
        Schema::create('products', function (Blueprint $table) {
         
            $table->id();

            $table->string('name')->nullable(false);
            $table->float('price')->default(0);
            $table->text('description')->nullable(true);
            $table->integer('counter')->default(0);
            $table->boolean('deleteStatuse')->default(0);
            $table->string('image')->nullable(false);
            $table->string('file')->nullable(false);
            $table->string('video')->nullable(false);
            $table->boolean('free')->default(0);
            $table->boolean('license')->default(0);
            $table->boolean('slider')->default(0);
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
