<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesReturn;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    public function index(){
        return view('sales.return');
    }
    public function store(Request $request)
    {

        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', 'Please select an organization.');
        }
        foreach ($request->product_id as $key => $item) {
            SalesReturn::create([
                'sales_id' => $request->sales_id,
                'product_id' => $request->product_id[$key],
                'quantity' => $request->quantity[$key],
                'organization_id' => $org_id,
            ]);
            $product = Product::where('id', $request->product_id[$key])->where('organization_id', $org_id)->first();

            $product->update([
                'stock' => $product->stock + $request->quantity[$key],
            ]);
        }

        return redirect()->back()->with('success', "Product returned.");
    }

    function salesReturn($invoice)
    {
        $data = Sales::with('customer', 'salesProduct.product.unit')->where('invoice_number', $invoice)->where('organization_id', orgId())->latest()->first();
        return response()->json([
            'data' => $data,
        ]);
    }
}
