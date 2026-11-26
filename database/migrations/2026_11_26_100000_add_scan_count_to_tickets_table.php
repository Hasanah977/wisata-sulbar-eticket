<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('tickets', 'scan_count')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->unsignedInteger('scan_count')->default(0)->after('qr_token');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tickets', 'scan_count')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('scan_count');
            });
        }
    }
};
