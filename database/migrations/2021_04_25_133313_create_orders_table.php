<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('condition');
            $table->string('type');
            $table->string('direction');
            $table->string('start');
            $table->text('description');
            $table->tinyInteger('work_id')->default(1); //статус
            $table->tinyInteger('client_id')->default(0); // кто заказал
            $table->tinyInteger('user_id')->default(0); // кто работает(админ либо зам. админ)
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
