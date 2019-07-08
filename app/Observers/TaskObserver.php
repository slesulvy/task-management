<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    public function created(Task $task){
        $project = $task->board;
        $project->progress = $project->getProgress();
        $project->save();
    }
    public function updated(Task $task)
    {
        $project = $task->board;
        $project->progress = $project->getProgress();
        $project->save();
    }
}
