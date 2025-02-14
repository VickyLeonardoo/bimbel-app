<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function items(){
        return $this->hasMany(TransactionItem::class);
    }

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class, 'transaction_items')->withPivot('price');
    }

    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
