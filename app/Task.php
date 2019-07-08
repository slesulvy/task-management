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

    function progressing(){
        if($this->progress == 0){

        }
        elseif($this->progress > 0 && $this->progress < 100){

        }
        elseif($this->progress == 100){

        }else{
            if($this->step == 1){
                $this->progress = 0;
            }
            elseif ($this->step == 2){
                $this->progress = 10;
            }
            elseif($this->step == 3){
                $this->progress = 100;
            }
        }
    }

}
