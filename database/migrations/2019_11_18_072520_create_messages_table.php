<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->default(0)->comment('产品ID');
            $table->json('product_info')->nullable()->comment('产品快照');
            $table->string('ip',30)->nullalbe()->comment('游客Ip');
            $table->string('email',50)->comment('邮箱');
            $table->string('phone',30)->nullable()->comment('电话');
            $table->string('skype',60)->nullable()->comment('skype');
            $table->string('name')->comment('名字');
            $table->text('msg')->comment('名字');
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
        Schema::dropIfExists('messages');
    }
}
