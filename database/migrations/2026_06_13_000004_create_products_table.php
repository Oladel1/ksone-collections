<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('category'); // mule, slide, loafer, etc.
            $table->text('description')->nullable();
            $table->unsignedInteger('price'); // in Naira (no decimals)
            $table->string('image')->nullable(); // relative path: products/file.jpeg
            $table->string('badge')->nullable(); // popular, premium, new, etc.
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
