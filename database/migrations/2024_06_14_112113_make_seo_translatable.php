<?php

declare(strict_types=1);

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
        Schema::table('seo', function (Blueprint $table) {
            $table->json('description')->default('[]')->change();
            $table->json('title')->default('[]')->change();
            $table->json('image')->default('[]')->change();
            $table->json('author')->default('[]')->change();
            $table->json('robots')->default('[]')->change();
            $table->json('canonical_url')->default('[]')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seo', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('author')->nullable()->change();
            $table->string('robots')->nullable()->change();
            $table->string('canonical_url')->nullable()->change();
        });
    }
};
