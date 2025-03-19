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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique()->nullable();
            $table->string('title')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('listing_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('listing_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('listing_id')->references('id')->on('listings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
        Schema::dropIfExists('listing_subscriptions');
    }
};
