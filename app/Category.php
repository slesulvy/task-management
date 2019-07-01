<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="category";
    public $primaryKey="category_id";

    protected $hidden = [
        'category_id','created_at','updated_at'
    ];

    public function board()
    {
        return $this->belongsTo('App\Category', 'category_id','category_id');
    }

}
