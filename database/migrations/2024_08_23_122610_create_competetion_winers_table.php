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
        Schema::create('competetion_winers', function (Blueprint $table) {
            $table->id();

            $table->text('file');
            $table->text('discreption');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('competetion_id');
            $table->foreign('competetion_id')->references('id')->on('competiotions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unique(['competetion_id', 'user_id']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competetion_winers');
    }
};
