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
       Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_stocks_id')->unique();
            $table->string('name');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('batch_id');
            $table->date('expired_date');
            $table->timestamps();

            $table->foreignId('medicine_types_id')->nullable()->constrained();
            $table->foreignId('medicine_categories_id')->nullable()->constrained();
            $table->foreignId('medicine_suppliers_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_stocks');
    }
};
