<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToOrderProceeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_proceeds', function (Blueprint $table) {
            $table->string('image', 70)->after('paid_at')->comment('图片')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_proceeds', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
