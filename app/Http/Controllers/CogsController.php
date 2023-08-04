<?php

namespace App\Http\Controllers;

use App\Models\Cogs;
use App\Models\FiscalYear;
use Illuminate\Http\Request;

class CogsController extends Controller
{
    public function store(Request $request){
        $org_id=orgId();
        if(!$org_id){
            return redirect()->back()->with('error',"Please select an organization.");
        }

        $fiscalYear=FiscalYear::where('organization_id',$org_id)->where('status',1)->first();
        if(!$fiscalYear){
            return redirect()->back()->with('error',"Please select fiscal year.");
        }
        $data=$request->validate([
            'opening_stock'=>'required',
        ]);


        $data['organization_id']=$org_id;
        $data['fiscal_year_id']=$fiscalYear->id;

        Cogs::create($data);
        // return $data;
        return redirect()->back()->with('success',"Opening Balance Saved Successfully.");

    }
}
