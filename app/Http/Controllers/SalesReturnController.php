<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesReturn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesReturnController extends Controller
{
    public function index(){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $salesReturns=SalesReturn::with(['product.unit','sales.customer','branch'])->where('organization_id',$org_id)->latest()->get();
        return view('sales.return',compact('salesReturns'));
    }
    public function store(Request $request)
    {

        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $carbonInstance = Carbon::now();

        $year = $carbonInstance->year;    // Get the year as an integer
        $month = $carbonInstance->month;  // Get the month as an integer
        $day = $carbonInstance->day;
        $date = ad_to_bs($year, $month, $day);

        $MyDate = $date['year'] . "-" . $date['month'] . "-" . $date['day'];


        foreach ($request->product_id as $key => $item) {
            SalesReturn::create([
                'sales_id' => $request->sales_id,
                'product_id' => $request->product_id[$key],
                'quantity' => $request->quantity[$key],
                'organization_id' => $org_id,
                'reason' => $request->reason[$key],
                'returnDate'=>$MyDate,
                'branch_id'=>Auth()->user()->employee->branch_id,
                'sales_id'=>Auth()->user()->employee->branch_id,
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
        $data = Sales::with('customer', 'salesProduct.product.unit','salesProduct.sales')->where('invoice_number', $invoice)->where('organization_id', orgId())->latest()->first();
        return response()->json([
            'data' => $data,
        ]);
    }
}
