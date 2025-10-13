<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_name');
            $table->text('clinic_address');
            $table->string('clinic_phone', 20);
            $table->string('clinic_email');
            $table->string('clinic_logo')->nullable();
            $table->json('opening_hours')->nullable();
            $table->decimal('default_consultation_fee', 10, 2)->default(0);
            $table->integer('min_stock_alert_threshold')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};