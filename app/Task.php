<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TaskHandler;
use App\Board;

class Task extends Model
{
    protected $table="tasks";
    public $primaryKey="id";

    protected $hidden = [
        'updated_at'
    ];

    function handler()
    {
        return $this->hasMany(TaskHandler::class, 'task_id', 'id');
    }

    function board()
    {
        return $this->hasOne(Board::class, 'project_id', 'project_id');
    }

    

}
