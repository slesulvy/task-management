<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Board;
use App\Task;
use App\TaskHandler;
use App\BoardMember;
use App\TaskComment;

class HomeController extends Controller
{
    public function index()
    {
        //DB::enableQueryLog();
        /*$board = Board::with(['category',
            'members' => function ($query) {
                $query->where('user_id', '=', Auth::user()->id);
            },    
        ])->where('status',1)->get();*/
        $board = DB::table('projects')
            ->select('projects.*', 'category_name', 'project_member.user_id')
            ->join('category', 'projects.category_id', '=', 'category.category_id')
            ->join('project_member', 'project_member.project_id', '=', 'projects.project_id')
            ->where([['projects.status',1],['project_member.user_id', Auth::user()->id],['project_member.status',1]])
            ->get();
        //dd(DB::getQueryLog());

        return view('pages.index', ['board'=>$board]);
    }

    function boards()
    {
        $board = Board::where('created_by', Auth::user()->id)
                        ->orderBy('project_id', 'desc')
                        /*->take(10)*/
                        ->get();
        return view('pages.boardlist', ['board'=>$board]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $board = new Board;
        $board->category_id = $request->category_id;
        $board->projectname = $request->projectname;
        $board->description = $request->description;
        $board->created_by = Auth::user()->id;
        $board->save();
        $boardmember = new BoardMember;
        $boardmember->project_id = $board->project_id;
        $boardmember->user_id = Auth::user()->id;
        $boardmember->assign_by = Auth::user()->id;
        $boardmember->save();

        DB::commit();

        return back()->with('success', 'Your images has been successfully');
    }

    public function show($id)
    {
        //
    }

    public function close($id)
    {
        $board = Board::where('project_id','=', $id)
                        ->where('created_by','=',Auth::user()->id)
                        ->first();
        if(count($board) == 1){
            $board->status = 0;
            $board->closed_by = Auth::user()->id;
            $board->save();
        }
        return back(); 
    }

    public function restore($id)
    {
        $board = Board::where('project_id','=', $id)
                        ->where('created_by','=',Auth::user()->id)
                        ->first();
        if(count($board) == 1){
            $board->status = 1;
            $board->closed_by = Auth::user()->id;
            $board->save();
        }
        return back(); 
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function get_board_member($board)
    {
        $boardMember = DB::table('project_member')
            ->select('project_member.*','users.name')
            ->join('projects', 'project_member.project_id', '=', 'projects.project_id')
            ->join('users', 'project_member.user_id', '=', 'users.id')
            ->where('project_member.project_id',$board)
            ->where('project_member.status',1)
            ->orderBy('project_member.id')
            ->get();
        $this->showMember($boardMember);   
            
    }

    public function users_select_opt()
    {
        $user = User::where('status',1)->orderBy('name')->get();
        foreach ($user as $item) {
            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
    }

    public function showMember($members)
    {
        $i = 0;
        foreach ($members as $item) {
            $i++;
            echo '<tr style="height:25px;" id="tr_'.$item->id.'">
                <td align="center">'.$i.'</td>
                <td>'.$item->name. (($i==1?'<span class="pull-right text-success">&nbsp; <i class="fa fa-lock" aria-hidden="true"></i> Creator&nbsp;</span>':'')).'</td>
                <td style="padding:0px; vertical-align:middle;" align="center">'.(($i!=1)?'<a href="javascript:void(0);" onclick="rm_pro_member('.$item->id.')" class="btn btn-xs btn-default" style="border-radius:0px;"><i class="fa fa-trash"></i></a>':'').'</td>
            </tr>';
        }
    }

    public function addmember($project, $member)
    {
        $boardmember = new BoardMember;
        $boardmember->project_id = $project;
        $boardmember->user_id = $member;
        $boardmember->assign_by = Auth::user()->id;
        $boardmember->save();
        $this->get_board_member($project);
    }

    public function remove_pro_member($project, $id)
    {
        $boardmember = BoardMember::where('id','=', $id)
                                    ->where('project_id','=',$project)
                                    ->whereColumn('user_id','<>','assign_by')
                                    ->delete();                                    
        /*if(count($boardmember) == 1){
            $boardmember->status = 0;
            $boardmember->removed_by = Auth::user()->id;
            $boardmember->save();
        }*/
        $this->get_board_member($project);
    }

    /**
     * Task Methods start from this section
     */

    public function tasks($id)
    {
        DB::enableQueryLog();
        $board = DB::table('projects')
            ->join('project_member', 'project_member.project_id', '=', 'projects.project_id')
            ->where([['projects.status',1],['project_member.user_id', Auth::user()->id],['project_member.status',1],['project_member.project_id',$id]])
            ->get();

        $projectmember = DB::table('project_member')
                            ->join('users','users.id','=','project_member.user_id')
                            ->where('project_member.project_id',$id)->get();

        if(count($board)<1) 
        {
            return redirect('board');
        }   

        $tasktodo = Task::with('handler')
                ->where('project_id', $id)
                ->orderBy('id', 'desc')
                ->get();

        $board = Board::where('project_id','=', $id)->first();            
        return view('pages.task',compact('tasktodo', 'board','projectmember'));
    }

    public function addtask(Request $request)
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
            $this->gettask($task->id);
        DB::commit();
    }

    public function edittask($id)
    {
        $task = Task::find($id);
        $member = TaskHandler::with('getUser')->where('task_id', $id)->orderBy('id', 'desc')->get();
        $comment = TaskComment::with('getUser','task')->where('task_id', $id)->orderBy('id', 'desc')->get();
        echo json_encode(array('task'=>$task, 'handler'=>$member,'comment'=>$comment));
    }

    public function updatetask(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->where('created_by','=',Auth::user()->id)
                        ->first();
        if(count($task) == 1){
            $task->description = $request->description;
            $task->due_date = date_format(date_create($request->due_date),'Y-m-d');
            $task->priority = $request->priority;
            $task->save();
        }
        
    }

    public function gettask($id)
    {
        $task = Task::find($id);
        $member = TaskHandler::with('getUser')
                ->where('task_id', $id)
                ->orderBy('id', 'desc')
                ->first();
        echo '<li task_id="'.$task->id.'" class="warning-element ui-sortable-handle btn-update-task" id="_'.$task->id.'" style="" data-Id="'.$task->id.'" data-toggle="modal" data-target="#taskmodal">
                <div class="agile-detail" style="padding:0 0 5px 0; text-align:left; margin-top:0px;">
                <i class="fa fa-star"></i>&nbsp;
                <i class="fa fa-star-o"></i>&nbsp;
                <i class="fa fa-star-o"></i>  
                <i class="fa fa-thumb-tack pull-right" aria-hidden="true"></i>
                </div>
                '.$task->taskname.'
                <div class="agile-detail">    
                <span title="Due Date" class="label label-warning"><i class="fa fa-clock-o"></i>'.'</span>
                <a href="#" class="btn btn-xs pull-right" style="border:none;">
                    <img src="'.asset('img/'.$member->getUser->img).'" width="17px;" class="img img-circle">   
                </a> 
                </div>
            </li>';
    }

    public function addtaskmember(Request $request, $task_id)
    {
        $taskmember = DB::table('taskhandlers')
                        ->where('task_id', $task_id)
                        ->where('user_id', $request->user_id)
                        ->get();
        if(count($taskmember)<1) {
            $handler = new TaskHandler;
            $handler->task_id = $task_id;
            $handler->user_id = $request->user_id;
            $handler->created_by = Auth::user()->id;
            $handler->save();
        }

        $member = TaskHandler::with('getUser')->where('task_id', $task_id)->orderBy('id', 'desc')->get();
        echo json_encode(array('handler'=>$member));
        app('App\Http\Controllers\BotController')->updateDescriptionTask(Auth::user()->id,$task->tastname);
    }

    function gettaskmember($task_id)
    {
        $projectmember = DB::table('taskhandlers')
                            ->join('users','users.id','=','taskhandlers.user_id')
                            ->where('taskhandlers.task_id',$task_id)->get();
        return $projectmember;
    }

    function update_priority(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->first();
        if(count($task) == 1){
            $task->priority = $request->priority;
            $task->save();
        }
    }

    function update_description(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->first();
        //if(count($task) == 1){
            $task->description = $request->description;
            $task->save();
        //}
        echo json_encode(array('user'=>Auth::user()->name,'taskname'=>$task->taskname));
        //app('App\Http\Controllers\BotController')->updateDescriptionTask(Auth::user()->name,$task->taskname);
    }

    function update_duedate(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->first();
        if(count($task) == 1){
            $task->due_date = date_format(date_create($request->due_date),'Y-m-d');
            $task->save();
        }
    }

    function comment(Request $request)
    {
        DB::beginTransaction();
        $comment = new TaskComment();
        $comment->task_id=$request->task_id;
        $comment->user_id=Auth::user()->id;
        $comment->comments=$request->comment;
        $comment->save();
        DB::commit();
        $this->get_signle_comment($comment->id);
    }

    function get_signle_comment($id)
    {
        $comment = TaskComment::with('getUser','task')
                ->where('id', $id)
                ->orderBy('id', 'desc')
                ->first();
        //dd($comment);
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
                    </div>
                </div>
            </div>';
    }

    function update_step(Request $request)
    {
        DB::enableQueryLog();
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
        
        DB::commit();
        echo json_encode(DB::getQueryLog());
    }


    /**
     * List Page
     */

    public function tasklist()
    {
        DB::enableQueryLog();
        $task = Task::with('handler','board')
                ->orderBy('project_id', 'desc')
                ->get();
        //$board = Board::where('project_id','=', $id)->first();            
        return view('pages.tasklist',compact('task'));
    }
    
    public function closetask($id)
    {
        $task = Task::where('id','=', $id)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
        if(count($task) == 1){
            $task->status = 0;
            $task->save();
        }
        return back(); 
    }

    public function restoretask($id)
    {
        $task = Task::where('id','=', $id)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
        if(count($task) == 1){
            $task->status = 1;
            $task->save();
        }
        return back(); 
    }

}
