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
        Schema::create('license_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('license_id');
            $table->foreign('license_id')->references('id')->on('licenses')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            // $table->unsignedBigInteger('basket_id');
            // $table->foreign('basket_id')->references('id')->on('baskets')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            $table->string('license_key')->nullable();

            $table->string('device_identifier')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_records');
    }
};
