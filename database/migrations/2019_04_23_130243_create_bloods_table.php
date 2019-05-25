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
            $table->integer('o_pos')->default('0');
            $table->integer('o_neg')->default('0');
            $table->integer('a_pos')->default('0');
            $table->integer('a_neg')->default('0');
            $table->integer('b_pos')->default('0');
            $table->integer('b_neg')->default('0');
            $table->integer('ab_pos')->default('0');
            $table->integer('ab_neg')->default('0');
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
