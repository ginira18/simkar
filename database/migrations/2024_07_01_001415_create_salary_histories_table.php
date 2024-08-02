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
        Schema::create('salary_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->integer('base_salary');
            $table->integer('fix_allowance');
            $table->integer('cut_insurance')->nullable();
            $table->integer('cut_attendance')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('cut_other')->nullable();
            $table->integer('total_salary');
            $table->string('department');
            $table->string('position');
            $table->string('bpjs');
            $table->integer('jumlahHariKerja');
            $table->integer('hadir');
            $table->integer('izin');
            $table->integer('alpha');
            $table->integer('terlambat');
            
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_histories');
    }
};
