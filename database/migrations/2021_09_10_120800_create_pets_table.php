<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('species', 255);
            $table->string('birth_date', 255);
            $table->string('document', 20);
            $table->text('history');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('owner_id')->references('id')->on('owners');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}