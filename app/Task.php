<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TaskHandler;
use App\Board;

class Task extends Model
{
    protected $table="tasks";
    public $primaryKey="id";
    protected $appends = array('danger_level', 'expected_hours', 'current_hours', 'actual_hours');


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

    public function getExpectedHoursAttribute(){
        if($this->start_date){
            if($this->due_date){
                $due = strtotime($this->due_date);
                $start = strtotime($this->start_date);
                $datediff = $due - $start;
                $datediff = round($datediff / (60 * 60 * 24));
                $hours = ($datediff * 8) + 8;

                return $hours;
            }
        }
        return 0;
    }
    public function getCurrentHoursAttribute(){
        $now = time();
        if($this->start_date){
                $start = strtotime($this->start_date);
                $datediff = $now - $start;
                $datediff = round($datediff / (60 * 60 * 24));
                $hours = ($datediff * 8) + 8;
                return $hours;
        }
        return 0;
    }
    public function getActualHoursAttribute(){
        if($this->start_date){
            if($this->finish_date){
                $finish = strtotime($this->finish_date);
                $start = strtotime($this->start_date);
                $datediff = $finish - $start;
                $datediff = round($datediff / (60 * 60 * 24));
                $hours = ($datediff * 8) + 8;
                return $hours;
            }
        }
        return 0;
    }
}
