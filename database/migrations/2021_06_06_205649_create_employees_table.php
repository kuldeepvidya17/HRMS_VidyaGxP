<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
// {
//     Schema::create('employees', function (Blueprint $table) {
//         $table->id();
//         $table->string('firstname', 255)->notNull();
//         $table->string('lastname', 255)->notNull();
//         $table->string('email', 255)->notNull();
//         $table->string('phone', 255)->nullable();
//         $table->bigInteger('department_id')->unsigned()->nullable();
//         $table->bigInteger('designation_id')->unsigned()->nullable();
//         $table->string('company', 255)->nullable();
//         $table->string('avatar', 255)->nullable();
//         $table->timestamps();
//         $table->softDeletes();
//     });
// }

public function up()
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('firstname', 255)->notNull();
        $table->string('lastname', 255)->notNull();
        $table->string('email', 255)->notNull();
        $table->string('phone', 255)->nullable();
        $table->bigInteger('department_id')->unsigned()->nullable();
        $table->bigInteger('designation_id')->unsigned()->nullable();
        $table->string('company', 255)->nullable();
        $table->string('avatar', 255)->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
