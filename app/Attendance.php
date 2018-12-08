<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'st_attendance';
    protected $fillable = ['lecture', 'student', 'value'];

    public function lecture_data(){
        return $this->belongsTo('App\Lectures', 'lecture');
    }
    public function student_data(){
        return $this->belongsTo('App\Students', 'student');
    }
}
