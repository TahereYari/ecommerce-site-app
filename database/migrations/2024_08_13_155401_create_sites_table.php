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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('tel')->nullable();
            $table->text('experience')->nullable();
            $table->text('completed_projects')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('instagram')->nullable();
            $table->string('tweeter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('telegram')->nullable();
            $table->text('address')->nullable();
            $table->text('descirbe')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
