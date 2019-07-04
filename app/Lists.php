<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table="project_lists";
    public $primaryKey="list_id";

    protected $fillable = [
        'project_id', 'list_title', 'status','created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
