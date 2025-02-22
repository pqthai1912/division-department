<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('name', 50);
            $table->unsignedBigInteger('division_id');
            $table->date('entered_date');
            $table->tinyInteger('position_id');
            $table->date('created_date');
            $table->date('updated_date');
            $table->date('deleted_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
