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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('passport')->unique()->after('nrc')->nullable(true);
            $table->enum('application_status', ['new', 'namelist', 'medical_checkup', 'buy_insurance', 'wp_fee','bt50', 'wp_permit'])->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('passport');
            $table->dropColumn('application_status');
        });
    }
};