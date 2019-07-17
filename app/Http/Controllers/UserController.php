<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
class UserController extends Controller
{


//     function __construct()
//     {
//
//         $this->middleware('permission:user-list');
//         $this->middleware('permission:user-create', ['only' => ['create','store']]);
//         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
//         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
//
//     }

    public function index(Request $request)
    {
         $data = User::all()->where('status','1');
        return view('users.index',compact('data'))->with('i');
    }


    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles','position'));

    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
//            'profile'     =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by'=>'required',
            'roles' => 'required'

        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if($request->hasFile('profile')) {
            $file         = $request->profile;
            $timestamp    = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name         = $timestamp. '-' .$file->getClientOriginalName();
            $input['img']  = $name;
            $file->move(public_path('/images'), $name);
        }
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')

                        ->with('success','User created successfully');

    }

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole','position'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
//            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required'
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
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');

    }

    public function destroy($id)
    {
//        $is_active['status']  = '0';
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

}