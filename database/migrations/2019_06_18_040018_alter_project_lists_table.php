<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('project_lists', function (Blueprint $table) {
            $table->bigIncrements('list_id');
            $table->bigInteger('project_id');
            $table->string('list_title');
            $table->bigInteger('created_by');
            $table->bigInteger('modified_by');
            $table->bigInteger('deleted_by');
            $table->datetime('deleted_at');
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });*/

        Schema::table('project_lists', function (Blueprint $table) {
            $table->integer('created_by')->nullable()->change();
            $table->integer('deleted_by')->nullable()->change();
            $table->integer('modified_by')->nullable()->change();
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
