<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Purchase;
use App\Models\PurchaseAmount;
use App\Models\PurchasePayment;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    public function payment($id)
    {
        $org_id = orgId();
        $edit=false;
        $purchase = Purchase::where('organization_id', $org_id)->where('id', $id)->with('product', 'supplier', 'purchaseProduct.product.unit', 'tax')->first();
        $organization = Organization::where('id', $org_id)->first();
        $amount = PurchaseAmount::where('purchase_id', $id)->first();
        // return $pay;
        if (!$purchase) {
            return redirect()->back()->with('error', "Data not found");
        }

        return view('purchase.payment', compact('purchase', 'organization', 'amount','edit'));
    }

    public function repayment($id)
    {
        $org_id = orgId();
        $edit=true;
        $purchase = Purchase::where('organization_id', $org_id)->where('id', $id)->with('product', 'supplier', 'purchaseProduct.product.unit', 'tax')->first();
        $organization = Organization::where('id', $org_id)->first();
        $amount = PurchaseAmount::where('purchase_id', $id)->first();
        // return $pay;
        if (!$purchase) {
            return redirect()->back()->with('error', "Data not found");
        }

        return view('purchase.payment', compact('purchase', 'organization', 'amount','edit'));
    }

    public function pay(Request $request)
    {
        $paythrough="other";
        if($request->pay_through){
            $paythrough=$request->pay_through;
        }
        PurchasePayment::create([
            'organization_id' => orgId(),
            'purchase_id' =>$request->purchase_id,
            'paid_amount' =>$request->paying,
            'remaining_amount' =>$request->total-$request->paying,
            'pay_through'=>$paythrough,
        ]);

        Purchase::where('id',$request->purchase_id)->first()->update([
            'due'=>$request->total-$request->paying,
        ]);

        return redirect()->route('purchase.index')->with('success',"Payment successfull.");
    }
}
