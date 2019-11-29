<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',100)->comment('标题');
            $table->integer('category_id')->comment('产品分类');
            $table->text('desc_0')->nullable()->comment('详情1');
            $table->text('desc_1')->nullable()->comment('详情2');
            $table->text('desc_2')->nullable()->comment('详情3');
            $table->string('seo_title', 150)->nullable()->comment('SEO-标题');
            $table->string('seo_keywords', 150)->nullable()->comment('SEO-关键字');
            $table->string('seo_desc', 200)->nullable()->comment('SEO-描述');
            $table->tinyInteger('order')->default(0)->comment('排序');
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
        Schema::dropIfExists('products');
    }
}
