<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'st_students';
    protected $fillable = ['name', 'surname', 'email', 'number', 'views', 'image'];
}
