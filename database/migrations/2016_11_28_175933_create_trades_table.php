<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type');
            $table->decimal('total_value', 12, 2);
            $table->decimal('discount', 12, 2);
            $table->decimal('final_value', 12, 2);

            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('people');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::table('product_movements', function ($table) {
            $table->integer('trade_id')->unsigned()->nullable();
            $table->foreign('trade_id')->references('id')->on('trades');
        });
    }

    public function down()
    {
        Schema::table('product_movements', function($table) {
            $table->dropForeign(['trade_id']);
            $table->dropColumn('trade_id');
        });
        Schema::dropIfExists('trades');
    }
}
