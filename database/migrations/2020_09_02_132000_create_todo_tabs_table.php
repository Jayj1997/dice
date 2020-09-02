<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id');
            $table->foreign('todo_id')->references('id')->on('todos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->unsignedInteger('finish_rate')->default(0);
            $table->unsignedInteger('fail_rate')->default(0);
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
        Schema::dropIfExists('todo_tabs');
    }
}
