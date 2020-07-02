<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('category_id')->after('value')->nullable()->comment('分类');
            $table->tinyInteger('type')->after('category_id')->default(1)->comment('类型，1：文本，2：图片');
            $table->tinyInteger('order')->after('type')->nullable()->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
