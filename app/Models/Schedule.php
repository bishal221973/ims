<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function hour($in,$out)
    {
        $startTime = strtotime($in);
        $endTime = strtotime($out);

        $hourDifference = ($endTime - $startTime) / 3600; // 3600 seconds in an hour

        return $hourDifference;
    }
}
