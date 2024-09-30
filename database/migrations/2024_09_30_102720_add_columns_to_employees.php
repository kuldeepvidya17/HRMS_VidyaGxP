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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('Employee_id')->unique(); // Unique Employee ID, still using string for IDs
            $table->longText('position')->nullable(); // Position of the employee
            $table->longText('area')->nullable(); // Area of the employee
            $table->longText('employee_type')->nullable(); // Type of employee
            $table->date('date_of_joining')->nullable(); // Date of joining
            $table->longText('aadhaar_no')->nullable(); // Aadhaar number (optional)
            $table->longText('passport_no')->nullable(); // Passport number
            $table->longText('contact_no')->nullable(); // Contact number
            $table->longText('card_no')->nullable(); // Employee card number
            $table->longText('permanent_address')->nullable(); // Permanent address
            $table->date('birthday')->nullable(); // Birthday
            $table->longText('nick_name')->nullable(); // Nickname (optional)
            $table->longText('office_tel')->nullable(); // Office telephone number
            $table->longText('religion')->nullable(); // Religion
            $table->longText('Pincode')->nullable(); // Pincode
            $table->longText('gender')->nullable(); // Gender (male/female)
            $table->longText('Motorcycle_lic')->nullable(); // Motorcycle License number
            $table->longText('autoMobil_license')->nullable(); // AutoMobil License number
            $table->longText('city')->nullable(); // City of residence
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
