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
        Schema::table('license_records', function (Blueprint $table) {
            $table->unsignedBigInteger('basket_id');
            $table->foreign('basket_id')->references('id')->on('baskets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('license_records', function (Blueprint $table) {
            //
        });
    }
};
