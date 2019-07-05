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
            $table->bigInteger('created_by');
            $table->bigInteger('modified_by');
            $table->bigInteger('deleted_by');
            $table->datetime('deleted_at');
            $table->smallInteger('status')->default(1);
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE project_lists AUTO_INCREMENT = 4;");
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
