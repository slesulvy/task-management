<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table="projects";
    public $primaryKey="project_id";

    protected $hidden = [
        'created_at','updated_at'
    ];

    protected $fillable=[
        'project_id','category_id','projectname','description','status'
    ];


    public function category(){
        return $this->hasOne('App\Category', 'category_id', 'category_id');
    }

    public function board()
    {
        return $this->hasMany('App\Task', 'project_id','project_id');
    }

    public function members()
    {
        return $this->hasMany('App\BoardMember', 'project_id', 'project_id');
    }

}

