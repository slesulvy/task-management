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

class ProjectController extends Controller
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

    function list()
    {
        $board = DB::table('projects')
            ->select('projects.*', 'project_member.user_id')
            ->join('project_member', 'project_member.project_id', '=', 'projects.project_id')
            ->where([['project_member.user_id', Auth::user()->id],['project_member.status',1]])
            ->get();
        /*$board = Board::orderBy('project_id', 'desc')
                        ->get();*/
        return view('pages.boardlist', ['board'=>$board]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();

        $board = new Board;
        $board->category_id = $request->category_id;
        $board->projectname = $request->projectname;
        $board->description = $request->description;
        $board->back_color = $request->back_color;
        $board->font_color = $request->font_color;
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

    public function close($id)
    {
        $board = Board::where('project_id','=', $id)
                        ->where('created_by','=',Auth::user()->id)
                        ->first();
            $board->status = 0;
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
      public function destroy($id)
    {
          DB::table('tasks')
            ->where('id',$id)
            ->update(['status' => "2"]);
         return back('board');
     }
      public function task_update_step(Request $request,$id){
      
          $task = Task::where('id','=', $id)->first();
          $task->step = $request->all_step;
          
          $task->save();
    }




   
}
