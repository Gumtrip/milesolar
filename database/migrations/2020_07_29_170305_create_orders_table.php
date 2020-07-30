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
            $table->decimal('total_amount')->comment('总额，营业收入');
            $table->char('currency',10)->comment('货币');
            $table->float('exchange_rate',8,4)->comment('兑换成人民币汇率');
            $table->decimal('rmb_total_amount')->comment('人民币营业收入');
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
