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
        Schema::table('wallets_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('wallets_logs', 'notes')) {
                $table->string('notes')->nullable()->after('status');
            }
            if (!Schema::hasColumn('wallets_logs', 'reference')) {
                $table->string('reference')->nullable()->after('ip');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets_logs', function (Blueprint $table) {
            if (Schema::hasColumn('wallets_logs', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('wallets_logs', 'reference')) {
                $table->dropColumn('reference');
            }
        });
    }
};
