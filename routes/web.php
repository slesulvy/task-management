<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/board');
});

//Auth::routes();

/*Route::group(['prefix' => 'cp','namespace'=>'Cpanel','middleware'=>'auth'], function () {

    Route::get('/home', 'HomeController@index');

});*/

Auth::routes();

Route::get('login',[ 'as' => 'login','uses' =>'LoginController@index']);
Route::post('authenticate',[ 'as' => 'authenticate','uses' =>'LoginController@authenticate']);
Route::get('logout',[ 'as' => 'logout','uses' =>'LoginController@logout']);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware'=>'auth'], function () {
    
    Route::get('board','HomeController@index');
    Route::post('board/addnew',[ 'as' => 'board/addnew','uses' => 'HomeController@store']);
    Route::get('board/{id}',[ 'as' => 'board/{id}','uses' => 'HomeController@tasks']);

    Route::get('board/close/{id}',[ 'as' => 'board/close/{id}','uses' => 'HomeController@close']);
    Route::get('board/restore/{id}',[ 'as' => 'board/restore/{id}','uses' => 'HomeController@restore']);

    Route::get('task/close/{id}',[ 'as' => 'task/close/{id}','uses' => 'HomeController@closetask']);
    Route::get('task/restore/{id}',[ 'as' => 'task/restore/{id}','uses' => 'HomeController@restoretask']);

    //PROJECT MEMBER
    Route::get('getboardmember/{id}',['as' => 'getboardmember/{id}', 'uses' =>'ProjectMemberController@get']);
    Route::get('addmember/{project}/{member}',['as' => 'addmember/{project}/{member}', 'uses' =>'ProjectMemberController@add']);
    Route::get('removemember/{project}/{member}',['as' => 'removemember/{project}/{member}', 'uses' =>'ProjectMemberController@remove']);
    //END PROJECT MEMBER

    Route::get('addtaskmember/{taskid}',['as'=>'addtaskmember/{taskid}', 'uses'=>'HomeController@addtaskmember']);
    Route::get('setpriority/{id}',['as'=>'setpriority/{id}','uses'=>'HomeController@update_priority']);
    Route::get('setdescription/{id}',['as'=>'setdescription/{id}','uses'=>'HomeController@update_description']);
    Route::get('setduedate/{id}',['as'=>'setduedate/{id}','uses'=>'HomeController@update_duedate']);

    Route::post('comment',['as'=>'comment','uses'=>'TaskCommentController@comment']);

    Route::get('movestep',['as'=>'movestep','uses'=>'HomeController@update_step']);

    Route::get('getacomment/{id}',['as'=>'getacomment/{id}','uses'=>'TaskCommentController@get_signle_comment']);

    Route::get('boards',[ 'as' => 'boards','uses' => 'HomeController@boards']);

    Route::get('tasks',[ 'as' => 'tasks','uses' => 'HomeController@tasklist']);

    Route::get('newtask',[ 'as' => 'addtask','uses' => 'HomeController@addtask']);
    Route::get('board/edittask/{id}','HomeController@edittask');
    Route::get('board/updatetask/{id}',[ 'as' => 'board/updatetask/{id}','uses' => 'HomeController@updatetask']);
    Route::get('board/destroy/{id}',[ 'as' => 'board/destroy/{id}','uses' => 'HomeController@destroy']);
    Route::get('board/task_update_step/{id}',[ 'as' => 'board/task_update_step/{id}','uses' => 'HomeController@task_update_step']);



    
    Route::get('gettask/{id}',[ 'as' => 'gettask/{id}','uses' => 'HomeController@gettask']);

    Route::post('addlist',[ 'as' => 'addlist','uses' => 'HomeController@addlist']);
    Route::get('removelist/{id}',[ 'as' => 'removelist/{id}','uses' => 'HomeController@remove_list']);
    //remove_list($id)

    Route::get('category',[ 'as' => 'category','uses' => 'CategoryController@index']);
    Route::get('addcategory',[ 'as' => 'addcategory','uses' => 'CategoryController@store']);
    Route::get('category/close/{id}',[ 'as' => 'category/close/{id}','uses' => 'CategoryController@closecategory']);
    Route::get('category/restore/{id}',[ 'as' => 'category/restore/{id}','uses' => 'CategoryController@restorecategory']);


    Route::get('users',[ 'as' => 'users','uses' =>'UserController@index']);
    Route::post('users/add',[ 'as' => 'users/add','uses' => 'UserController@store']);
    Route::get('users/edit/{id}','UserController@edit');
    Route::post('users/update',[ 'as' => 'users/update','uses' => 'UserController@update']);
    Route::get('users/disable/{id}',[ 'as' => 'users/disable/{id}','uses' => 'UserController@disableUser']);

    Route::get('role',[ 'as' => 'role','uses' => 'RoleController@index']);
    Route::post('role/add',[ 'as' => 'role/add','uses' => 'RoleController@store']);
    Route::get('role/edit/{id}','RoleController@edit');
    Route::get('role/disable/{roleId}',[ 'as' => 'role/disable/{roleId}','uses' => 'RoleController@disableRole']);
    Route::post('role/update',[ 'as' => 'role/update','uses' => 'RoleController@update']);

    Route::get('users_select_opt','HomeController@users_select_opt');

    Route::get('profile',['as'=>'profile','uses'=>'ProfileController@index']);

    //TASK PROGRESS
    Route::get('task/progress/{task}/edit','TaskProgressController@edit');
    Route::post('task/progress','TaskProgressController@set');
    //END TASK PROGRESS

    // sent notification to telegram
    Route::get('sentBot', '\App\Http\Controllers\BotController@sentMessageToTelegram');
    Route::get('api/updateDescription', 'BotController@updateDescriptionTask');
    Route::get('api/createTask', 'BotController@createTask');
    Route::get('api/achiveTask', 'BotController@achiveTask');
    Route::get('api/addTaskMember', 'BotController@addMemberToTask');
    Route::get('api/setPriorityTask', 'BotController@setPriorityTask');
    Route::get('api/taskComment', 'BotController@taskComment');
    //Route::get('api/moveTask', '\App\Http\Controllers\BotController@updateDescriptionTask');
    Route::get('api/setduedate', '\App\Http\Controllers\BotController@setDueDate');
   
});