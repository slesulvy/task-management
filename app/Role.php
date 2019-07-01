<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table="sys_role";
    public $primaryKey="id";

    protected $hidden = [
        'created_at','updated_at'
    ];

    protected $fillable = [
        'role_name'
    ];

}
