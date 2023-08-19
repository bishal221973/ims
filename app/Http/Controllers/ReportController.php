<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\SalesProduct;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function purchaseReport(){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $purchases = PurchaseProduct::where('organization_id',$org_id)->with('product.unit','purchase.supplier')->get();

        return view('report.purchase',compact('purchases'));
    }

    public function salesReport(){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $sales = SalesProduct::where('organization_id',$org_id)->with('product.unit','sales.customer')->get();
        return view('report.sales',compact('sales'));
    }

    public function inventoryReport(){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $products=Product::where('organization_id',$org_id)->with('unit','brand','category')->orderBy('stock','desc')->get();
        return view('report.inventory',compact('products'));
    }
}
