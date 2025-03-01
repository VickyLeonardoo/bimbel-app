<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Children extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function parent(){
        return $this->belongsTo(User::class);
    }

}
