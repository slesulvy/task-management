<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskhandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskhandlers', function (Blueprint $table) {
            $table->bigIncrements('handlerid');
            $table->bigInteger('task_id');
            $table->bigInteger('user_id')->nullable();
            $table->smallInteger('created_by')->default(0);
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
        Schema::dropIfExists('taskhandlers');
    }
}
