<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOfferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_offer_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_offer_id')->comment('报价订单ID');
            $table->integer('product_id')->comment('产品id');
            $table->integer('amount')->default(1)->comment('产品数量');
            $table->string('unit')->default('PCS')->comment('产品单位');
            $table->string('currency')->default('USD')->comment('币种');
            $table->decimal('unit_price', 10, 2)->default(1)->comment('产品单价');
            $table->string('title', 100)->comment('产品描述');
            $table->string('img', 80)->comment('产品图片');
            $table->text('desc')->comment('产品描述');
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
        Schema::dropIfExists('order_offer_items');
    }
}
