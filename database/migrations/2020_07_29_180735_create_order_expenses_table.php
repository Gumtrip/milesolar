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
            $table->string('expense')->comment('支出名称');
            $table->decimal('expense_amount',2)->comment('支出费用，人民币');
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
