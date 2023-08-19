<?php

namespace App\Http\Controllers;

use App\Models\FiscalYear;
use App\Models\PurchasePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function totalPurchase($month)
    {
        $org_id=orgId();
        $fiscalYear=FiscalYear::where('organization_id',$org_id)->where('status',1)->first();
        return DB::table('purchase_amounts')
            ->join('purchases', 'purchases.id', 'purchase_amounts.purchase_id')
            ->where('purchases.organization_id', $org_id)
            ->where('purchases.fiscal_year_id', $fiscalYear->id)
            ->whereMonth('purchases.transaction_date',$month)
            ->sum('purchase_amounts.grand_total');
            // ->get();
    }
    public function totalSales($month)
    {
        $org_id=orgId();
        $fiscalYear=FiscalYear::where('organization_id',$org_id)->where('status',1)->first();

        return DB::table('sales_amounts')
            ->join('sales', 'sales.id', 'sales_amounts.sales_id')
            ->where('sales.organization_id', $org_id)
            ->where('sales.fiscal_year_id', $fiscalYear->id)
            ->whereMonth('sales.transaction_date',$month)
            ->sum('sales_amounts.grand_total');
            // ->get();
    }
}
