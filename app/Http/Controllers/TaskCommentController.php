<?php

namespace App\Http\Controllers;
use \Illuminate\Support\Facades\DB;

use \Illuminate\Http\Request;
use \Auth;
use \App\User;
use \App\Task;
use \App\TaskComment;

class TaskCommentController extends Controller
{
    function comment(Request $request)
    {
        DB::beginTransaction();

        if($request->description!='')
        {
            $comment = new TaskComment();
            $comment->task_id = $request->task_id;
            $comment->user_id = Auth::user()->id;
            $comment->status = '1';
            $comment->comments = $request->description;
            $comment->save();
        }
        if($request->file('select_file')!='')
        {
            $comment = new TaskComment();
            $comment->task_id = $request->task_id;
            $comment->user_id = Auth::user()->id;
            $comment->status = '1';
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/images'), $new_name);
            $comment->image = $new_name;
            $comment->save();
        }
        
        DB::commit();
        $this->get_signle_comment($comment->id);
    }

    function get_signle_comment($id)
    {
        $comment = TaskComment::with('getUser','task')
                ->where('id', $id)
                ->orderBy('id', 'desc')
                ->first();
        echo '<div class="feed-element">
                <a href="#" class="pull-left">
                    <img alt="image" class="img-circle" src="'.asset('img/'.$comment->getUser->img).'">
                </a>
                <div class="media-body ">
                    <small class="pull-right">1m ago</small>
                    <strong>'.$comment->getUser->name.'</strong> commented on task "<strong>'.$comment->task->taskname.'</strong>"<br>
                    <small class="text-muted">'.date_format(date_create($comment->created_at),'H:i').' - '.date_format(date_create($comment->created_at),'d-M-Y').'</small>
                    <div class="well">
                    '.$comment->comments.'
                    <a href="'.asset('images/'.$comment->image).'">
                        '.$comment->image.'
                    </a>
                    </div>
                </div>
            </div>';
    }
}
