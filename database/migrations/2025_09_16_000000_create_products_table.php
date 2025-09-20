<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->index(); // e.g., Cat Food, Dog Food, Supplies, Vitamin
            $table->string('sku')->unique();
            $table->unsignedInteger('price'); // store in smallest currency unit (e.g., Rupiah)
            $table->unsignedInteger('stock')->default(0);
            $table->string('status')->default('available')->index(); // available, coming-soon, preorder
            $table->text('description')->nullable();
            $table->string('image_path')->nullable(); // public path or storage path
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
