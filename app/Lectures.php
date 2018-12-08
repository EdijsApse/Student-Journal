<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lectures extends Model
{
    protected $table = 'st_lectures';
    protected $fillable = ['title', 'description', 'date'];

    public function lecture_attendance(){
        return $this->hasMany('App\Attendance', 'lecture');
    }

}
