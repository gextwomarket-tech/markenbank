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
        Schema::create('crypto_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('currency'); // ex: 'BTC', 'ETH', 'USDT'
            $table->string('address');
            $table->string('network')->nullable(); // ex: 'ERC20', 'TRC20'
            $table->string('qr_code_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['currency', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_addresses');
    }
};
