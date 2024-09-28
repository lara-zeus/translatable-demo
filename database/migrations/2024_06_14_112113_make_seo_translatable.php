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
            $table->json('description')->nullable()->change();
            $table->json('title')->nullable()->change();
            $table->json('image')->nullable()->change();
            $table->json('author')->nullable()->change();
            $table->json('robots')->nullable()->change();
            $table->json('canonical_url')->nullable()->change();
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
