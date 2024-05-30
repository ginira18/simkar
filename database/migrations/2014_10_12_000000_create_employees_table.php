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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('NIP')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->enum('religion', ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']);
            $table->string('phone_number');
            $table->string('last_education');
            $table->text('address');
            $table->date('hire_date');
            $table->date('hire_date_end');
            $table->string('position');
            $table->enum('employee_type', ['monthly', 'daily']);
            $table->enum('bpjs', ['bpjs', 'no_bpjs']);
            $table->unsignedBigInteger('department_id');
            $table->timestamps();


            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
