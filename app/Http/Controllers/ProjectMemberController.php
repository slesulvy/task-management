<?php

namespace App\Http\Controllers;

use App\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectMemberController extends Controller
{
    //
    public function show($members)
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

    public function add($project, $member)
    {
        $boardmember = new BoardMember;
        $boardmember->project_id = $project;
        $boardmember->user_id = $member;
        $boardmember->assign_by = Auth::user()->id;
        $boardmember->save();
        $this->get($project);
    }

    public function remove($project, $id)
    {
        $boardmember = BoardMember::where('id','=', $id)
            ->where('project_id','=',$project)
            ->whereColumn('user_id','<>','assign_by')
            ->delete();
        $this->get($project);
    }

    public function get($board)
    {
        $boardMember = DB::table('project_member')
            ->select('project_member.*','users.name')
            ->join('projects', 'project_member.project_id', '=', 'projects.project_id')
            ->join('users', 'project_member.user_id', '=', 'users.id')
            ->where('project_member.project_id',$board)
            ->where('project_member.status',1)
            ->orderBy('project_member.id')
            ->get();
    // echo json_encode($boardMember);exit();
        $this->show($boardMember);

    }
}
