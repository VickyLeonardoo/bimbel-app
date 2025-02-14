<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = ['id'];

    public function children(){
        return $this->belongsTo(Children::class);
    }

    public function session_course(){
        return $this->belongsTo(SessionCourse::class);
    }
}
