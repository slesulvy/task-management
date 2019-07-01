<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $table="project_member";
    public $primaryKey="id";

    protected $hidden = [
        'created_at','updated_at'
    ];

    protected $fillable=[
        'user_id','project_id','status'
    ];

    public function board()
    {
        return $this->belongsTo('App\Board','project_id','project_id');
    }
}
