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
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('religion');
            $table->string('phone_number');
            $table->string('last_education');
            $table->text('address');
            $table->date('hire_date');
            $table->date('hire_date_end');
            $table->string('position');
            $table->enum('employee_type', ['monthly', 'daily']);
            $table->enum('bpjs', ['yes', 'no']);
            $table->timestamps();

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
