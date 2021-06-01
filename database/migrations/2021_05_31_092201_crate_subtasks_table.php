<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateSubtasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('subtasks',function(Blueprint $table){
            $table->id('id');
            $table->integer('task_id');
            $table->string('title');
            $table->string('description');
            $table->timestamp('start')->useCurrent();
            $table->timestamp('deadline')->useCurrent();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('subtasks');
    }
}
