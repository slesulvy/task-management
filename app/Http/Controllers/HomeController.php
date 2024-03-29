<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Board;
use App\Lists;
use App\Task;
use App\TaskHandler;
use App\BoardMember;
use App\TaskComment;

class HomeController extends Controller
{
    public function index()
    {
        $board = DB::table('projects')
            ->select('projects.*', 'category_name', 'project_member.user_id')
            ->join('category', 'projects.category_id', '=', 'category.category_id')
            ->join('project_member', 'project_member.project_id', '=', 'projects.project_id')
            ->where([['projects.status',1],['project_member.user_id', Auth::user()->id],['project_member.status',1]])
            ->get();

        return view('pages.index', ['board'=>$board]);
    }

    function boards()
    {
        $board = DB::table('projects')
            ->select('projects.*')
            //->join('project_member', 'project_member.project_id', '=', 'projects.project_id')
            //->where([['project_member.user_id', Auth::user()->id],['project_member.status',1], ['projects.status', '!=', 2]])
            ->where([['projects.created_by', Auth::user()->id],['projects.status', '!=', 2]])
            ->get();
        /*$board = Board::orderBy('project_id', 'desc')
                        ->get();*/
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
            $board->status = 2;
            $board->closed_by = Auth::user()->id;
            $board->save();
        return back(); 
    }

    public function restore($id)
    {
        $board = Board::where('project_id','=', $id)
                        ->where('created_by','=',Auth::user()->id)
                        ->first();
            $board->status = 1;
            $board->closed_by = Auth::user()->id;
            $board->save();
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

    public function task_update_step(Request $request,$id){
      
          $task = Task::where('id','=', $id)->first();
          $task->step = $request->all_step;    
          $task->save();
    }

     public function destroy($id)
    {
          DB::table('tasks')
            ->where('id',$id)
            ->update(['status' => "2"]);
     return back('board');
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
        //DB::enableQueryLog();
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
                //->orderBy('id', 'desc')
                ->get();

        $results = DB::select( DB::raw(" SELECT 1 AS id, 'Thing To-do' title 
            UNION 
            SELECT 2 AS id, 'In Progress' title
            UNION
            SELECT 3 AS id, 'Done' title
            UNION
            SELECT list_id id, list_title title  FROM project_lists WHERE status =1 AND project_id = '$id'") );

        //echo json_encode($results);exit();
       
        $board = Board::where('project_id','=', $id)->first();            
        return view('pages.task',compact('tasktodo', 'board','projectmember','list','results'));
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
            $task->description = $request->description;
            $task->due_date = date_format(date_create($request->due_date),'Y-m-d');
            $task->priority = $request->priority;
            $task->save();
   
    }

    public function gettask($id)
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
                    <img src="'.asset('img/'.$member->getUser->img).'" width="17px" height="17px" class="img img-circle">   
                </a> 
                <div class="progress priority-' . $task->priority . '" style="margin-top:10px;">
                    <div class="progress-bar progress-bar-striped progress-bar-{{ $item->priority }} task-progress" role="progressbar" style="width: {{ $item->progress }}%" aria-valuenow="{{ $item->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
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
        $addedMember = TaskHandler::with('getUser')->where([['task_id', $task_id],['user_id',$request->user_id]])->first();
        echo json_encode(array('handler'=>$member,'addedmember'=>$addedMember));
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
            $task->priority = $request->priority;
            $task->save();
    }

    function update_description(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->first();
            $task->description = $request->description;
            $task->save();
        echo json_encode(array('user'=>Auth::user()->name,'taskname'=>$task->taskname));

    }

    function update_duedate(Request $request, $id)
    {
        $task = Task::where('id','=', $id)
                        ->first();
        // if(count($task) == 1){
            $task->start_date = date_format(date_create($request->start_date),'Y-m-d');
            $task->due_date = date_format(date_create($request->due_date),'Y-m-d');
            $task->save();
        echo json_encode(array('user'=>Auth::user()->name,'taskname'=>$task->taskname,'duedate'=>date_format(date_create($request->due_date),'Y-m-d')));
    }

    function comment(Request $request)
    {
        DB::beginTransaction();

        if($request->description!='')
        {
            $comment = new TaskComment();
            $comment->task_id = $request->task_id;
            // dd($comment);
            $comment->user_id = Auth::user()->id;
            $comment->status = '1';
            //$image = $request->file('select_file');
            //$new_name = rand() . '.' . $image->getClientOriginalExtension();
            //$image->move(public_path('/images'), $new_name);
            
            //$comment->images = $new_name;
            $comment->comments = $request->description;
            $comment->save();
        }
        if($request->file('select_file')!='')
        {
            $comment = new TaskComment();
            $comment->task_id = $request->task_id;
            // dd($comment);
            $comment->user_id = Auth::user()->id;
            $comment->status = '1';
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/images'), $new_name);
            
            $comment->image = $new_name;
            //$comment->comments = $request->description;
            $comment->save();
        }
        
        /*$comment = new TaskComment();
        $comment->task_id = $request->task_id;
 
        $comment->user_id = Auth::user()->id;
        $comment->status = '1';
        $image = $request->file('select_file');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/images'), $new_name);
         
        $comment->images = $new_name;
        $comment->comments = $request->description;
        $comment->save();*/

         // return response()->json([
         //   'message'   => 'Image Upload Successfully',
         //   'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
         //   'class_name'  => 'alert-success'
         //  ]);
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
                    <img alt="image" class="img-circle" src="'.asset('img/'.$comment->getUser->img).'" width="35px" height="35px">
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

    function update_step(Request $request)
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
            //echo json_encode(DB::getQueryLog());
            DB::commit();
            //echo $item->list_id.' => '.$request->input('step_'.$item->list_id).'\n';
        }

        DB::commit();
        //echo json_encode(DB::getQueryLog());
    }


    /**
     * List Page
     */

    public function tasklist($project_id=0)
    {
        DB::enableQueryLog();

            $task = Task::with(['handler','board'])       
                            ->whereIn('id', TaskHandler::where('user_id', Auth::user()->id)
                            ->pluck('task_id')->toArray())
                            ->orWhere(
                                function($task)  { 
                                    $task->whereIn('project_id', BoardMember::where('assign_by', Auth::user()->id)
                                    ->whereColumn('user_id','=','assign_by')
                                    ->pluck('project_id')->toArray());
                                }
                            )
                            ->orderBy('project_id', 'desc')
                            ->get();
            if($project_id > 0){
                $task = $task->where('project_id', $project_id);
            }
            $task = $task->where('status', '!=', 2);

            $board = Board::whereIn('project_id', BoardMember::where('user_id', Auth::user()->id)
            ->pluck('project_id')->toArray())
            ->orderBy('projectname', 'asc')
            ->get();

        return view('pages.tasklist',compact('task','board'));
    }
    
    public function closetask($id)
    {
        $task = Task::where('id','=', $id)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
            $task->status = 0;
            $task->save();
        return back(); 
    }

    public function restoretask($id)
    {
        $task = Task::where('id','=', $id)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
            $task->status = 1;
            $task->save();
        return back(); 
    }
}
