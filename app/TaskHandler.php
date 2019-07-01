<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TaskHandler extends Model
{
    protected $table="taskhandlers";
    public $primaryKey="id";

    protected $hidden = [
        'updated_at'
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    /*function handler()
    {
        return $this->belongsTo('App\User', 'task_id', 'id');
    }*/

    function getUser()
    {
        //return $this->hasMany('App\User', 'id', 'user_id');
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function toArray()
    {
        $p = parent::toArray();
        return array_merge($p, array(
            'getUser'  =>$this->getUser()
        ));
    }

}
