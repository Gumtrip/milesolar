<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->comment('名字');
            $table->string('email',50)->nullable()->comment('email');
            $table->string('mobile',30)->nullable()->comment('移动电话');
            $table->string('skype',30)->nullable()->comment('skype');
            $table->string('whatsapp',30)->nullable()->comment('whatsapp');
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
        Schema::dropIfExists('clients');
    }
}
