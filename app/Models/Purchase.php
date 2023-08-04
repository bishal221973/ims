<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function tax()
    {
        return $this->hasMany(PurchaseTax::class);
    }

    // public function pay()
    // {
    //     return $this->hasMany(Pay::class);
    // }

    public function purchaseProduct()
    {
        return $this->hasMany(PurchaseProduct::class);
    }
    public function purchaseAmount()
    {
        return $this->hasOne(PurchaseAmount::class);
    }
}
