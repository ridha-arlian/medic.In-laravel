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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_number')
                ->unique();
            $table->string('nik', 16)
                ->unique();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->string('phone_number', 20);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])
                ->nullable();
            $table->text('medical_history')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('medical_record_number');
            $table->index('nik');
            $table->index('full_name');
        });

        Schema::create('patient_drug_allergies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('medicine_stock_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('custom_medicine_name')
                ->nullable();
            $table->text('reaction')
                ->nullable();
            $table->timestamps();
            
            $table->index('custom_medicine_name');
            $table->unique(['patients_id', 'medicine_stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
        Schema::dropIfExists('patient_drug_allergies');
    }
};