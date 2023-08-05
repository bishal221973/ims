<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Cogs;
use App\Models\FiscalYear;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseAmount;
use App\Models\PurchaseProduct;
use App\Models\PurchaseTax;
use App\Models\Supplier;
use App\Models\Tax;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function openingBalance(Cogs $cogs)
    {
        $cogss = Cogs::where('organization_id', orgId())->get();
        return view('cogs', compact('cogs', 'cogss'));
    }

    public function index()
    {
        $purchases=Purchase::where('organization_id',orgId())->with('product', 'supplier', 'purchaseProduct.product.unit', 'tax','purchaseAmount')->latest()->get();
        return view('purchase.purchaseList',compact('purchases'));
    }
    public function create()
    {
        $org_id = orgId();
        $products = Product::where('organization_id', $org_id)->latest()->get();
        $taxs = Tax::where('organization_id', $org_id)->latest()->get();
        $suppliers = Supplier::where('organization_id', $org_id)->latest()->get();
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        return view('purchase.purchase', compact('products', 'taxs', 'suppliers','branches'));
    }

    public function store(Request $request)
    {
        $subTotal = 0;
        $discount = 0;
        $taxableAmount = 0;
        $totalTaxRate = 0;
        $totalTaxAmount = 0;
        $grandTotal = 0;
        $orgId = orgId();

        $fiscalYearId = FiscalYear::select('id')->where('organization_id', $orgId)->where('status', 1)->first();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization.");
        }
        if (!$fiscalYearId) {
            return redirect()->back()->with('error', "Please select fiscal year.");
        }

        $purchaseData = $request->validate([
            'supplier_id' => 'required',
            'transaction_date' => 'required',
            'invoice_number' => 'required',
            'discount' => 'nullable',
            'branch_id'=>'required',
        ]);
        $purchaseData['organization_id'] = $orgId;
        $purchaseData['fiscal_year_id'] = $fiscalYearId->id;

        $purchase = Purchase::create($purchaseData);


        foreach ($request->product_id as $key => $item) {
            PurchaseProduct::create([
                'organization_id' => $orgId,
                'purchase_id' => $purchase->id,
                'product_id' => $request->product_id[$key],
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);
            $subTotal = $subTotal + ($request->quantity[$key] * $request->price[$key]);
            $product=Product::where('id',$request->product_id[$key])->first();
            $product->update([
                'stock'=>$product->stock+$request->quantity[$key]
            ]);
        }

        foreach ($request->tax as $key => $item) {
            PurchaseTax::create([
                'organization_id' => $orgId,
                'purchase_id' => $purchase->id,
                'tax_name' => Tax::where('id', $item)->first()->name,
                'tax_rate' => Tax::where('id', $item)->first()->value,
            ]);
            $totalTaxRate = $totalTaxRate + Tax::where('id', $item)->first()->value;
        }

        if ($request->discount != "") {
            $discount = $request->discount;
        }
        $taxableAmount = $subTotal - $request->discount;

        $totalTaxAmount = $taxableAmount * ($totalTaxRate / 100);
        $grandTotal = $taxableAmount - $totalTaxAmount;

        PurchaseAmount::create([
            'organization_id' => $orgId,
            'purchase_id' => $purchase->id,
            'subtotal' => $subTotal,
            'discount' => $discount,
            'taxable_amount' => $taxableAmount,
            'total_tax_rate' => $totalTaxRate,
            'total_tax_amount' => $totalTaxAmount,
            'grand_total' => $grandTotal,
        ]);

        $purchase->update([
            'due' => $grandTotal,
        ]);

        return redirect()->route('payment', $purchase->id)->with('success', "New purchase saved");
    }

    public function delete($id)
    {
        $data = Purchase::where('id', $id)->where('organization_id', orgId())->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->back()->with('success',"Purchase record removed");
    }
}
