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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['iban', 'crypto', 'paypal']);
            $table->boolean('is_active')->default(true);
            $table->json('config')->nullable(); // pour stocker configs spécifiques
            $table->decimal('fees_percentage', 5, 2)->default(0);
            $table->decimal('fees_fixed', 10, 2)->default(0);
            $table->decimal('min_amount', 20, 8)->nullable();
            $table->decimal('max_amount', 20, 8)->nullable();
            $table->timestamps();
            
            $table->index(['type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
