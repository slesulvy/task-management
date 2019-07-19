<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;
use App\User;
use DB;
use Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $profile = User::with('role','task.task','board.board')
                        ->where('id',$id)
                        ->first();
        return view('pages.profile',compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::find($id);
        return view('pages.edit_profile',compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }
        if($request->hasFile('profile')) {
            $file         = $request->profile;
            $timestamp    = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name         = $timestamp. '-' .$file->getClientOriginalName();
            $input['img']  = $name;
            $file->move(public_path('/images'), $name);
        }
//        dd($input);
        $user = User::find($id);
        $user->update($input);
//        DB::table('model_has_roles')->where('model_id',$id)->delete();
//        $user->assignRole($request->input('roles'));
        return redirect()->route('profile')
            ->with('success','User updated successfully');

    }

    public function destroy($id)
    {
        //
    }
}
