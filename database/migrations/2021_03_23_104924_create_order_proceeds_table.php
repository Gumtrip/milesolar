<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProceedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_proceeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no')->comment('转账流水号');
            $table->integer('order_id')->comment('外键，关联orders');
            $table->string('currency', 10)->default("CNY")->comment('币种');
            $table->string('img', 80)->nullable()->comment('图片');
            $table->decimal('total_amount', 10, 2)->default(0)->comment('收款金额');
            $table->decimal('rmb_total_amount', 10, 2)->default(0)->comment('人民币收款金额');
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
        Schema::dropIfExists('order_proceeds');
    }
}
