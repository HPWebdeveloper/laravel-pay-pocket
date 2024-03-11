<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('loggable');
            $table->string('wallet_name');
            $table->decimal('value', 16, 2);
            $table->decimal('from', 16, 2);
            $table->decimal('to', 16, 2);
            $table->string('type');
            $table->string('status')->default('Pending');
            $table->ipAddress('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets_logs');
    }
};
