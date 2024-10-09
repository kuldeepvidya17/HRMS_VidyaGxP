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
        Schema::create('new_employee_lists', function (Blueprint $table) {
            $table->id();
            $table->longText('first_name');
            $table->longText('last_name')->nullable();
            $table->string('email')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('department')->nullable();
            $table->longText('salary')->nullable();
            $table->longText('Address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_employee_lists');
    }
};
