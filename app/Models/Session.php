<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //

    protected $guarded = ['id'];

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
