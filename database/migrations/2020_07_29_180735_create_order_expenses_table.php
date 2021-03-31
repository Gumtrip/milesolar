<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->comment('订单外键');
            $table->string('title', 100)->comment('支出名称');
            $table->string('img', 80)->nullable()->comment('图片');
            $table->string('remark', 200)->nullable()->comment('备注');
            $table->decimal('total_amount', 10, 2)->comment('支出费用，人民币');
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
        Schema::dropIfExists('order_expenses');
    }
}
