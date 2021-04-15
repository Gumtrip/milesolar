<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFreightToOrderOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_offers', function (Blueprint $table) {
            $table->decimal('freight', 10, 2)->after('rmb_total_amount')->default(0)->comment('运费');
            $table->decimal('item_total_amount', 10, 2)->after('total_amount')->default(0)->comment('商品总价');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_offers', function (Blueprint $table) {
            $table->dropColumn('freight');
        });
    }
}
