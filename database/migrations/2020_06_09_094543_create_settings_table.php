<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table): void {
            $table->id();

            $table->string('group')->index();
            $table->string('name');
            $table->boolean('locked')->nullable(true);
            $table->json('payload');
            $table->timestamps();
        });
    }
}
