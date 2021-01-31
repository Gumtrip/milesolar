<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 200)->comment('题目');
            $table->string('slug', 200)->comment('slug');
            $table->string('image', 200)->comment('图片路径');
            $table->string('brief', 2048)->comment('简介');
            $table->text('content')->comment('详情内容');
            $table->string('seo_title', 150)->nullable()->comment('SEO-标题');
            $table->string('seo_keywords', 150)->nullable()->comment('SEO-关键字');
            $table->string('seo_desc', 200)->nullable()->comment('SEO-描述');
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
        Schema::dropIfExists('pages');
    }
}
