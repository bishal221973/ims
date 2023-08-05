<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\FiscalYear;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesAmount;
use App\Models\SalesPayment;
use App\Models\SalesProduct;
use App\Models\SalesTax;
use App\Models\Tax;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $org_id=orgId();
        $sales = Sales::where('organization_id', $org_id)->with(['product', 'customer', 'tax', 'salesProduct.product', 'salesAmount'])->latest()->get();
        return view('sales.salesList',compact('sales'));
    }
    public function create()
    {
        $org_id = orgId();
        $products = Product::where('organization_id', $org_id)->latest()->get();
        $taxs = Tax::where('organization_id', $org_id)->latest()->get();
        $customers = Customer::where('organization_id', $org_id)->latest()->get();
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        return view('sales.sales', compact(['products', 'taxs', 'customers', 'branches']));
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


        $salesData = $request->validate([
            'customer_id' => 'nullable',
            'transaction_date' => 'required',
            'invoice_number' => 'required',
            'discount' => 'nullable',
            'branch_id' => 'required',
        ]);
        $salesData['organization_id'] = $orgId;
        $salesData['fiscal_year_id'] = $fiscalYearId->id;
        if ($request->customer_id) {
            $salesData['customer_id'] = $request->customer_id;
        } else {
            $customer = Customer::create([
                'organization_id' => $orgId,
                'branch_id' => $request->branch_id,
                'name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
                'address' => $request->customer_address,
                'customer_vat_number' => $request->customer_customer_vat_number,
            ]);
            $salesData['customer_id'] = $customer->id;
        }

        $sales = Sales::create($salesData);

        foreach ($request->product_id as $key => $item) {
            SalesProduct::create([
                'organization_id' => $orgId,
                'sales_id' => $sales->id,
                'product_id' => $request->product_id[$key],
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
            ]);
            $subTotal = $subTotal + ($request->quantity[$key] * $request->price[$key]);
        }

        foreach ($request->tax as $key => $item) {
            SalesTax::create([
                'organization_id' => $orgId,
                'sales_id' => $sales->id,
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

        SalesAmount::create([
            'organization_id' => $orgId,
            'sales_id' => $sales->id,
            'subtotal' => $subTotal,
            'discount' => $discount,
            'taxable_amount' => $taxableAmount,
            'total_tax_rate' => $totalTaxRate,
            'total_tax_amount' => $totalTaxAmount,
            'grand_total' => $grandTotal,
        ]);

        $sales->update([
            'due' => $grandTotal,
        ]);

        return redirect()->route('sales.payment', $sales->id)->with('success', "New sales saved");
    }

    public function payment($id)
    {
        $org_id = orgId();
        $edit = false;
        $organization = Organization::where('id', $org_id)->first();
        $sales = Sales::where('organization_id', $org_id)->where('id', $id)->with(['product', 'customer', 'tax', 'salesProduct.product', 'salesAmount'])->first();
        return view('sales.payment', compact('organization', 'sales', 'edit'));
    }

    public function paySales(Request $request)
    {
        $paythrough="other";
        if($request->pay_through){
            $paythrough=$request->pay_through;
        }
        SalesPayment::create([
            'organization_id'=>orgId(),
            'sales_id'=>$request->sales_id,
            'paid_amount'=>$request->paying,
            'remaining_amount'=>$request->total-$request->paying,
            'pay_through'=>$paythrough,
        ]);

        Sales::where('id',$request->sales_id)->first()->update([
            'due'=>$request->total-$request->paying,
        ]);

        return redirect()->route('sales.index')->with('success',"Payment successfull.");
    }

    public function repayment($id)
    {
        $org_id = orgId();
        $edit=true;
        $sales = Sales::where('organization_id', $org_id)->where('id', $id)->with(['product', 'customer', 'tax', 'salesProduct.product', 'salesAmount'])->first();

        $organization = Organization::where('id', $org_id)->first();
        // return $pay;
        if (!$sales) {
            return redirect()->back()->with('error', "Data not found");
        }

        return view('sales.payment', compact('sales', 'organization','edit'));
    }

    public function delete($id)
    {
        $data = Sales::where('id', $id)->where('organization_id', orgId())->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('sales.index')->with('success',"Sales removed");
    }
}
