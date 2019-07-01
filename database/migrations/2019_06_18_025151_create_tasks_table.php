<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->bigInteger('project_id');
            $table->string('taskname')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('finish_date')->nullable();
            $table->smallInteger('priority')->default(0);
            $table->smallInteger('created_by')->default(0);
            $table->timestamps();
        });
    }

    /*Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');n
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
