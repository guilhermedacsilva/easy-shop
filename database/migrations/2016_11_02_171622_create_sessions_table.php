<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('repeat_type');
            $table->timestamp('end_at')->nullable()->default(null);
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('start_at_date');
            $table->time('start_at_time');
            $table->time('end_at_time');
            $table->integer('capacity');
            $table->text('note')->nullable();
            $table->integer('session_group_id')->unsigned()->nullable();
            $table->foreign('session_group_id')->references('id')->on('session_groups')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('session_groups');
    }
}
