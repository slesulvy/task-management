<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_lists', function (Blueprint $table) {
            $table->bigIncrements('list_id')->start_from(4);
            $table->bigInteger('project_id');
            $table->string('list_title');
<<<<<<< HEAD
            $table->bigInteger('created_by');
            $table->bigInteger('modified_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->smallInteger('status')->default(1);
=======
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('modified_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->smallInteger('status')->default(0);
>>>>>>> 5dd6c152d250a6bb1243c9e31f5a0ea5cfc48745
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
        Schema::dropIfExists('project_lists');
    }
}
