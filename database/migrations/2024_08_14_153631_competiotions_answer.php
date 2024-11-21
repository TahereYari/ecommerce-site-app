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
         Schema::create('competiotions_answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer')->nullable();
            $table->text('file')->nullable();
    
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
    
            $table->unsignedBigInteger('competiotion_id');
            $table->foreign('competiotion_id')->references('id')->on('competiotions')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
