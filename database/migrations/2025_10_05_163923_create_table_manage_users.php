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
        Schema::create('apotekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('stra_number')
                ->unique()
                ->comment('Surat Tanda Registrasi Apoteker');
            $table->string('phone_number');
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('str_number')
                ->unique()
                ->comment('Surat Tanda Registrasi');
            $table->foreignId('specialization_id')
                ->nullable()
                ->constrained('specializations');
            $table->string('phone_number');
            $table->text('address');
            $table->integer('consultation_fee');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apotekers');
        Schema::dropIfExists('dokters');
    }
};