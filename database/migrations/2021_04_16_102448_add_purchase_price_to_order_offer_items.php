<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchasePriceToOrderOfferItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_offer_items', function (Blueprint $table) {
            $table->decimal('purchase_price', 10, 2)->after('price')->comment('人民币')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_offer_items', function (Blueprint $table) {
            $table->dropColumn('purchase_price');
        });
    }
}
