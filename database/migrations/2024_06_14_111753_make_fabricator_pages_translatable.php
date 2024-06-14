<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public const TABLE = 'pages';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableName = self::TABLE;

        Schema::table($tableName, function (Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropUnique(['slug']);
        });

        Schema::table($tableName, function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('slug')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableName = self::TABLE;

        Schema::table($tableName, function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('slug')->change();
        });

        Schema::table($tableName, function (Blueprint $table) {
            $table->index(['title']);
            $table->unique(['slug']);
        });
    }
};
