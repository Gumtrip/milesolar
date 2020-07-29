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
            $table->bigIncrements('id');
            $table->string('no',80)->comment('订单号');
            $table->integer('client_id')->comment('客户Id');
            $table->integer('total_amount')->comment('总额，营业收入');
            $table->integer('currency')->comment('货币');
            $table->float('exchange_rate')->comment('兑换成人命币汇率');
            $table->integer('rmb_total_amount')->comment('人民币营业收入');
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
