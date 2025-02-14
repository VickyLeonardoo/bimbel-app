<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCourse extends Model
{
    //
    protected $guarded = ['id'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function year(){
        return $this->belongsTo(Year::class);
    }
}
