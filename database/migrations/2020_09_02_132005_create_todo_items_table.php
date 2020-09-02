<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id');
            $table->foreign('todo_id')->references('id')->on('todos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('tab_id')->nullable();
            $table->foreign('tab_id')->references('id')->on('todo_tabs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->unsignedInteger('priority')->default(0);
            $table->boolean('sub')->default(false);
            $table->boolean('important')->default(false);
            $table->dateTime('finish_at')->nullable();
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
        Schema::dropIfExists('todo_items');
    }
}
