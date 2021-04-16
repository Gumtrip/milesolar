<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidAtToOrderExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_expenses', function (Blueprint $table) {
            $table->timestamp('paid_at')->after('total_amount')->comment('支付时间')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_expenses', function (Blueprint $table) {
            $table->dropColumn('paid_at');
        });
    }
}
