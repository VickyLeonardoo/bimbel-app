<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function children(){
        return $this->belongsTo(Children::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }
}
