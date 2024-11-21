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
        Schema::create('ticket_messages', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('support_id')->nullable(true);
            // $table->foreign('support_id')->references('id')->on('users')
            // ->constrained()
            // ->onUpdate('cascade')
            // ->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->foreign('user_id')->references('id')->on('users')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->text('message')->nullable(true);
            $table->string('file')->nullable(true);

            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_messages');
    }
};
