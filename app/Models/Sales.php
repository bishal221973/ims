<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tax()
    {
        return $this->hasMany(SalesTax::class);
    }
    public function salesProduct()
    {
        return $this->hasMany(SalesProduct::class);
    }

    public function salesAmount()
    {
        return $this->hasOne(SalesAmount::class);
    }
}
