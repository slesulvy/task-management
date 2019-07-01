<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;

class TaskComment extends Model
{
    protected $table="taskcomments";
    public $primaryKey="id";

    protected $hidden = [
        'updated_at'
    ];

    function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function toArray()
    {
        $p = parent::toArray();
        return array_merge($p, array(
            'getUser'  =>$this->getUser()
        ));
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'task_id');
    }

}
