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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // ex: 'fr', 'en'
            $table->string('name'); // ex: 'Français', 'English'
            $table->string('flag')->nullable(); // emoji ou path
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->json('translations')->nullable(); // stocke les traductions
            $table->timestamps();
            
            $table->index(['is_active', 'is_default']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
