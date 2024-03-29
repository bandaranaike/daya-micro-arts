<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('art', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->unsignedSmallInteger('category_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->double('price')->nullable();
            $table->string('currency');
            $table->string('image')->default('default.png')->nullable();
            $table->string('duration', 50)->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('art');
    }
};
