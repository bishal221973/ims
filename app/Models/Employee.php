<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function user1(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function schedule(){
        return $this->hasOne(Schedule::class);
    }
    public function attendance(){
        return $this->hasMany(Attendance::class);
    }
}
