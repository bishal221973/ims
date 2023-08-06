<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\SalesProduct;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function purchaseReport(){
        $purchases = PurchaseProduct::where('organization_id',orgId())->with('product.unit','purchase.supplier')->get();

        return view('report.purchase',compact('purchases'));
    }

    public function salesReport(){
        $sales = SalesProduct::where('organization_id',orgId())->with('product.unit','sales.customer')->get();
        return view('report.sales',compact('sales'));
    }

    public function inventoryReport(){
        $products=Product::where('organization_id',orgId())->with('unit','brand','category')->orderBy('stock','descx`')->get();
        return view('report.inventory',compact('products'));
    }
}
