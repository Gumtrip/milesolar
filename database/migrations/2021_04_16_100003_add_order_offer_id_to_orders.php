<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderOfferIdToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_offer', function (Blueprint $table) {
            $table->tinyInteger('order_offer_id')->after('client_id')->nullable()->comment('关联报价订单');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_offer', function (Blueprint $table) {
            $table->dropColumn('order_offer_id');
        });
    }
}
