<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'st_students';
    protected $fillable = ['name', 'surname', 'email', 'number', 'views', 'image'];

    public static function getStudents(){
        return self::orderBy("name", "asc")->paginate(12);
    }

    public function addStudent(){
        
    }
}
