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
        Schema::create('division', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name', 255);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('division_leader_id');
            $table->integer('division_floor_num');
            $table->date('created_date');
            $table->date('updated_date');
            $table->date('deleted_date')->nullable();

            //foreign key
            // $table->foreign('division_leader_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('division');
    }
};
