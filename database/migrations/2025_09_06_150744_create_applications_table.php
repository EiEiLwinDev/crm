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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['new_customer', 'extension_customer', '90days_customer']);
            $table->enum('status', ['new', 'namelist', 'medical_checkup', 'buy_insurance', 'wp_fee', 'bt50', 'wp_permit']);

            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};