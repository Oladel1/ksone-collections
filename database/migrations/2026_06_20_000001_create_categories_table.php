<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');                    // e.g. Footwear, Bags, Belts
            $table->string('subtitle')->nullable();    // e.g. "Premium leather shoes"
            $table->text('description')->nullable();   // Longer description for the category page
            $table->string('icon_image')->nullable();  // Uploaded icon/image path
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
