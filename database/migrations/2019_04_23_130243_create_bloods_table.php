<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hospital_id');
            $table->integer('o+_balance')->default('0');
            $table->integer('o-_balance')->default('0');
            $table->integer('a+_balance')->default('0');
            $table->integer('a-_balance')->default('0');
            $table->integer('b+_balance')->default('0');
            $table->integer('b-_balance')->default('0');
            $table->integer('ab+_balance')->default('0');
            $table->integer('ab-_balance')->default('0');
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
        Schema::dropIfExists('bloods');
    }
}
