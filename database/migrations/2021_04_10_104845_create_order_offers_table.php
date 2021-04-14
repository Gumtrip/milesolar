<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no')->comment('报价Number');
            $table->integer('client_id')->comment('客户Id');
            $table->json('client_info')->nullable()->comment('客户信息');
            $table->string('currency', 30)->default('USD')->comment('币种');
            $table->decimal('total_amount', 10, 2)->default(0)->comment('总价');
            $table->decimal('rmb_total_amount', 10, 2)->default(0)->comment('人民币总价');
            $table->timestamp('offer_start')->comment('报价时效开始日期');
            $table->timestamp('offer_end')->comment('报价时效结束日期');
            $table->text('term')->comment('条款');
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
        Schema::dropIfExists('order_offers');
    }
}
