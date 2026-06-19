<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add category_id (nullable for backward compat with existing products)
            $table->foreignId('category_id')->nullable()->after('id')
                  ->constrained('categories')->nullOnDelete();

            // Rename 'category' to 'type' to avoid confusion with the new Category model
            $table->renameColumn('category', 'type');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('type', 'category');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
