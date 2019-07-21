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
    //SET FINISHED DATE
    public function updating(Task $task){
        if($task->progress) {
            if ($task->progress == 100) {
                $task->finish_date = now();
            } else {
                $task->finish_date = null;
            }
        }
    }
}
