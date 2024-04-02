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
        Schema::create('servings', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->unique();
            $table->foreignUuid('stock_id')->nullable();
            $table->foreignUuid('supplies_id')->nullable(); // todo: polymorphic table
            $table->text('description')->nullable();
            $table->integer('units')->default(0);
            $table->string('unit_type')->default('plate'); //plate | cup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servings');
    }
};
