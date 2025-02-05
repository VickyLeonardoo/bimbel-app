<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    //
    use SoftDeletes;

    protected $guarded = ['id'];

    public function children(){
        return $this->belongsTo(Children::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    
}
