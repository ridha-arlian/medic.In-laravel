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
        Schema::create('medicine_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 10)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();
        });

        Schema::create('medicine_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 10)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();
        });

        Schema::create('medicine_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->timestamps();
        });

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
        Schema::dropIfExists('medicine_types');
        Schema::dropIfExists('medicine_categories');
        Schema::dropIfExists('medicine_suppliers');
        Schema::dropIfExists('medicine_stocks');
    }
};