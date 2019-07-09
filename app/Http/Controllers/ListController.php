<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lists;
use DB;

class ListController extends Controller
{
    public function addlist(Request $request)
    {
        DB::beginTransaction();

        $list = new Lists;
        $list->project_id = $request->project_id;
        $list->list_title = $request->list_title;
        $list->created_by = Auth::user()->id;
        $list->save();

        DB::commit();

        return back()->with('success', 'Your images has been successfully');
    }
    function remove_list($id)
    {
        $list = Lists::where('list_id','=', $id)
                ->where('created_by','=',Auth::user()->id)
                ->first();
        $list->status = 0;
        $list->save();

        DB::table('tasks')
            ->where('step', $id)
            ->update(['status' => 0]);
        return back();
    }

}
