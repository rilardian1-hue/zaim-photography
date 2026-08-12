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
        Schema::table('photography_works', function (Blueprint $table) {
            $table->string('category')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photography_works', function (Blueprint $table) {
            // Because ENUM cannot be safely reverted, we just leave it as string 
            // or revert to the exact ENUM definition if strictly needed.
            // For safety, we keep it as string.
            $table->string('category')->change();
        });
    }
};
