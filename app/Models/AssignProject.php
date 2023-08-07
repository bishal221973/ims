<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProject extends Model
{
    use HasFactory;

    protected $guarded=['id'];


    public function employee()
    {
        return $this->hasMany(AssignEmployee::class,'assing_project_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
