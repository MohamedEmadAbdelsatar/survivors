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
            $table->string('o_pos')->default('0');
            $table->string('o_neg')->default('0');
            $table->string('a_pos')->default('0');
            $table->string('a_neg')->default('0');
            $table->string('b_pos')->default('0');
            $table->string('b_neg')->default('0');
            $table->string('ab_pos')->default('0');
            $table->string('ab_neg')->default('0');
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
