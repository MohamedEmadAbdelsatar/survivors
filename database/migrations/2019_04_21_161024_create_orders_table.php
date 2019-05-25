<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hospital_id');
            $table->string('user_id');
            $table->string('amount');
            $table->string('blood_type');
            $table->string('status');
            $table->string('to_id')->nullable();
            $table->string('try');
            $table->string('price')->nullable();
            $table->text('comment')->nullable();
            $table->integer('direct')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
