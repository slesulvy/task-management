<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $project = $task->board;
        $project->progress = $project->getProgress();
        $project->save();
    }
}
