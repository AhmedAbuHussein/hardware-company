<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('country');
            $table->integer('status');
            $table->integer('rating');
            $table->integer('approve');
            $table->timestamps();


            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('category_id')->references('id')->on('categorys');
            $table->foreign('user_id')->references('id')->on('users');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
