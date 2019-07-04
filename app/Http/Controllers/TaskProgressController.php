<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskProgressController extends Controller
{
    //
    public function edit(Task $task){
        return view('tasks.progress.edit',[
            'task' => $task
        ]);
    }

    public function set(request $request){
        $task = Task::find ($request->id);
        if( $request->progress >= 0 && $request->progress <= 100){
            if($request->progress < $task->progress){
                return response()->json(['error' => 'You can not lower your task progress!'], 404);
            }else{
                $task->progress = $request->progress;
                $task->save();
                return response()->json(['project_progress'=> $task->board->getProgress(), 'task' => $task]);
            }
        }else{
            if( $request->progress < 0 ){
                return response()->json(['error' => 'Did you mess up badly make your progress less than 0%?'], 404);
            }else{
                return response()->json(['error' => 'You think task can be done over 100%?'], 404);
            }

        }
    }
}
