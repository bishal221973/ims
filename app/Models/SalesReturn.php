<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function sales(){
        return $this->belongsTo(Sales::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
