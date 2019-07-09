<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Board;
use App\Task;
use App\TaskHandler;
use App\TaskComment;


class TaskController extends Controller
{
    public function updateStep(Request $request,$id){
      
        $task = Task::where('id','=', $id)->first();
        $task->step = $request->all_step;    
        $task->save();
    }

    public function delete($id)
    {
        DB::table('tasks')
            ->where('id',$id)
            ->update(['status' => "2"]);
        return back('board');
    }

    public function list($id)
    {
        DB::enableQueryLog();
        $board = DB::table('projects')
            ->join('project_member', 'project_member.project_id', '=', 'projects.project_id')
            ->where([['projects.status',1],['project_member.user_id', Auth::user()->id],['project_member.status',1],['project_member.project_id',$id]])
            ->get();

        $projectmember = DB::table('project_member')
                            ->join('users','users.id','=','project_member.user_id')
                            ->where('project_member.project_id',$id)->get();

        $list = DB::table('project_lists')
                            ->join('projects','projects.project_id','=','project_lists.project_id')
                            ->where([['projects.project_id',$id],['project_lists.status',1]])->get();

        if(count($board)<1)
        {
            return redirect('board');
        }   

        $tasktodo = Task::with('handler')
                ->where([['project_id', $id],['status',1]])
                ->orderBy('id', 'desc')
                ->where('project_id', $id)
                ->get();

        $results = DB::select( DB::raw(" SELECT 1 AS id, 'Thing To-do' title 
            UNION 
            SELECT 2 AS id, 'In Progress' title
            UNION
            SELECT 3 AS id, 'Done' title
            UNION
            SELECT list_id id, list_title title  FROM project_lists WHERE status =1 AND project_id = '$id'"));
        $board = Board::where('project_id','=', $id)->first();            
        return view('pages.task',compact('tasktodo', 'board','projectmember','list','results'));
    }

    public function add(Request $request)
    {
        DB::beginTransaction();
            $task = new Task;
            $task->project_id = $request->project_id;
            $task->taskname = $request->taskname;
            $task->created_by = Auth::user()->id;
            $task->save();     
            $handler = new TaskHandler;
            $handler->task_id = $task->id;
            $handler->user_id = Auth::user()->id;
            $handler->created_by = Auth::user()->id;
            $handler->save();
            $this->get($task->id);
            
        DB::commit();
    }

    public function get($id)
    {
        $task = Task::find($id);
        $member = TaskHandler::with('getUser')
                ->where('task_id', $id)
                ->orderBy('id', 'desc')
                ->first();
        echo '<li task_id="'.$task->id.'" class="'.$task->id.' default-element ui-sortable-handle btn-update-task" id="_'.$task->id.'" style="" data-Id="'.$task->id.'" data-toggle="modal" data-target="#taskmodal">
                '.$task->taskname.'
                <div class="agile-detail">    
                <span title="Due Date" class=""><i class="fa fa-clock-o"></i>'.'</span>
                <a href="#" class="btn btn-xs pull-right" style="border:none;">
                    <img src="'.asset('img/'.$member->getUser->img).'" width="17px;" class="img img-circle">   
                </a> 
                <div class="progress priority-' . $task->priority . '" style="margin-top:10px;">
                    <div class="progress-bar progress-bar-striped progress-bar-{{ $item->priority }} task-progress" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="{{ $item->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </li>';
    }

    public function edit($id)
    {
        $task = Task::find($id);
        $member = TaskHandler::with('getUser')->where('task_id', $id)->orderBy('id', 'desc')->get();
        $comment = TaskComment::with('getUser','task')->where('task_id', $id)->orderBy('id', 'desc')->get();
        echo json_encode(array('task'=>$task, 'handler'=>$member,'comment'=>$comment));
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->where('created_by','=',Auth::user()->id)
                        ->first();
        $task->description = $request->description;
        $task->due_date = date_format(date_create($request->due_date),'Y-m-d');
        $task->priority = $request->priority;
        $task->save();
    }

    function updatePriority(Request $request, $id)
    {
        $task = Task::where('id','=', $id)->first();
        $task->priority = $request->priority;
        $task->save();
    }

    function updateDescription(Request $request, $id)
    {
        $task = Task::where('id','=', $id)->first();
        $task->description = $request->description;
        $task->save();
        echo json_encode(array('user'=>Auth::user()->name,'taskname'=>$task->taskname));
    }

    function updateDue(Request $request, $id)
    {
        $task = Task::where('id','=', $id)->first();
        $task->start_date = date_format(date_create($request->start_date),'Y-m-d');
        $task->due_date = date_format(date_create($request->due_date),'Y-m-d');
        $task->save();
        echo json_encode(array('user'=>Auth::user()->name,'taskname'=>$task->taskname,'duedate'=>date_format(date_create($request->due_date),'Y-m-d')));
    }

    function moveStep(Request $request)
    {

        DB::beginTransaction();
        
        DB::table('tasks')
            ->whereIn('id',explode(',',$request->step_a))
            ->update(['step'=>1]);

        DB::table('tasks')
            ->whereIn('id',explode(',',$request->step_b))
            ->update(['step'=>2]);

        DB::table('tasks')
            ->whereIn('id',explode(',',$request->step_c))
            ->update(['step'=>3]);

        $list = DB::table('project_lists')
                        ->join('projects','projects.project_id','=','project_lists.project_id')
                        ->where([['projects.project_id',$request->project_id],['project_lists.status',1]])->get();

        foreach($list as $item){
            DB::enableQueryLog();
            DB::table('tasks')
            ->whereIn('id',explode(',',$request->input('step_'.$item->list_id)))
            ->update(['step'=>$item->list_id]);
            DB::commit();
        }
        DB::commit();
    }

    public function archive($id)
    {
        $task = Task::where('id','=', $id)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
        $task->status = 0;
        $task->save();
        return back(); 
    }

    public function restore($id)
    {
        $task = Task::where('id','=', $id)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
        $task->status = 1;
        $task->save();
        return back(); 
    }


}
