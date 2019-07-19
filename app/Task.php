<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TaskHandler;
use App\Board;

class Task extends Model
{
    protected $table="tasks";
    public $primaryKey="id";
    protected $appends = array('danger_level');


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

    public function getDangerLevelAttribute()
    {
        $now = time();
        if($this->due_date){
            $due_date = strtotime($this->due_date);
            $datediff = $due_date - $now;
            $datediff = round($datediff / (60 * 60 * 24));
            if($datediff <= 0){
                $datediff = 0;
            }
        }
        else{
            $datediff = 7;
        }
        return $datediff;
    }

}
