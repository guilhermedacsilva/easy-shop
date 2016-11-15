<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('quantity', 10, 2);
            $table->decimal('total_value', 10, 2);
            $table->tinyInteger('type');
            $table->integer('product_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('client_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('products_movements');
    }
}
