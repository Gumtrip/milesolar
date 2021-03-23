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
            $table->string('no', 80)->comment('订单号');
            $table->integer('client_id')->comment('客户Id');
            $table->decimal('total_amount')->default(0)->comment('总额，营业收入');
            $table->char('currency', 10)->default('CNY')->comment('货币');
            $table->decimal('exchange_rate', 8, 4)->default(1)->comment('兑换成人民币汇率');
            $table->decimal('rmb_total_amount')->default(0)->comment('人民币营业收入');
            $table->decimal('cost')->default(0)->comment('成本(货款+其他支出),人民币结算');
            $table->string('remark', 200)->nullable()->comment('备注');
            $table->softDeletes();
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
