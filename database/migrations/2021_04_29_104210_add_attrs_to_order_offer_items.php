<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrsToOrderOfferItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_offer_items', function (Blueprint $table) {
            $table->json('attrs')->after('img')->comment('属性');
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
            $table->dropColumn('attrs');
        });
    }
}
