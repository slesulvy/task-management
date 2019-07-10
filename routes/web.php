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

Auth::routes();

Route::get('login',[ 'as' => 'login','uses' =>'LoginController@index']);
Route::post('authenticate',[ 'as' => 'authenticate','uses' =>'LoginController@authenticate']);
Route::get('logout',[ 'as' => 'logout','uses' =>'LoginController@logout']);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware'=>'auth'], function () {
    
    Route::get('board','HomeController@index');
    Route::post('board/addnew',[ 'as' => 'board/addnew','uses' => 'HomeController@store']);

    Route::get('board/close/{id}',[ 'as' => 'board/close/{id}','uses' => 'HomeController@close']);
    Route::get('board/restore/{id}',[ 'as' => 'board/restore/{id}','uses' => 'HomeController@restore']);

    

    //PROJECT MEMBER
    Route::get('getboardmember/{id}',['as' => 'getboardmember/{id}', 'uses' =>'ProjectMemberController@get']);
    Route::get('addmember/{project}/{member}',['as' => 'addmember/{project}/{member}', 'uses' =>'ProjectMemberController@add']);
    Route::get('removemember/{project}/{member}',['as' => 'removemember/{project}/{member}', 'uses' =>'ProjectMemberController@remove']);
    //END PROJECT MEMBER

    Route::get('addtaskmember/{taskid}',['as'=>'addtaskmember/{taskid}', 'uses'=>'HomeController@addtaskmember']);
    

    // Task Comment 
    Route::post('comment',['as'=>'comment','uses'=>'TaskCommentController@comment']);
    Route::get('getacomment/{id}',['as'=>'getacomment/{id}','uses'=>'TaskCommentController@get_signle_comment']);
    // End Task Comment

    Route::get('boards',[ 'as' => 'boards','uses' => 'HomeController@boards']);

    Route::get('tasks',[ 'as' => 'tasks','uses' => 'HomeController@tasklist']);


    Route::post('addlist',[ 'as' => 'addlist','uses' => 'ListController@addlist']);
    Route::get('removelist/{id}',[ 'as' => 'removelist/{id}','uses' => 'ListController@remove_list']);
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

    Route::get('users_select_opt','UserController@users_select_opt');

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
    Route::get('api/setduedate', '\App\Http\Controllers\BotController@setDueDate');
    // task controller routing
    Route::get('board/{id}',[ 'as' => 'board/{id}','uses' => 'TaskController@list']);
    Route::get('gettask/{id}',[ 'as' => 'gettask/{id}','uses' => 'TaskController@get']);
    Route::get('task/close/{id}',[ 'as' => 'task/close/{id}','uses' => 'TaskController@archive']);
    Route::get('task/restore/{id}',[ 'as' => 'task/restore/{id}','uses' => 'TaskController@restore']);
    Route::get('setpriority/{id}',['as'=>'setpriority/{id}','uses'=>'TaskController@updatePriority']);
    Route::get('setdescription/{id}',['as'=>'setdescription/{id}','uses'=>'TaskController@updateDescription']);
    Route::get('setduedate/{id}',['as'=>'setduedate/{id}','uses'=>'TasKController@updateDue']);
    Route::get('movestep',['as'=>'movestep','uses'=>'TaskController@moveStep']);
    Route::get('newtask',[ 'as' => 'addtask','uses' => 'TaskController@add']);
    Route::get('board/edittask/{id}','TaskController@edit');
    Route::get('board/updatetask/{id}',[ 'as' => 'board/updatetask/{id}','uses' => 'TaskController@update']);
    Route::get('board/destroy/{id}',[ 'as' => 'board/destroy/{id}','uses' => 'TaskController@delete']);
    Route::get('board/task_update_step/{id}',[ 'as' => 'board/task_update_step/{id}','uses' => 'TaskController@updateStep']);
   
});