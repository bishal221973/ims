<?php

namespace App\Http\Controllers;

use App\Models\FiscalYear;
use Illuminate\Http\Request;

class FiscalYearController extends Controller
{
    public function index(FiscalYear $fiscalYear)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $fiscalYears = FiscalYear::where('organization_id', $org_id)->latest()->get();
        return view('configuration.fiscalYear', compact('fiscalYear', 'fiscalYears'));
    }

    public function store(Request $request)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'name' => 'required',
            'opening_date' => 'required',
            'closeing_date' => 'required',
        ]);
        $data['organization_id'] = $orgId;
        FiscalYear::create($data);

        return redirect()->back()->with('success', "Fiscal year saved");
    }

    public function active($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        foreach (FiscalYear::where('organization_id', $org_id)->get() as $fiscalYear) {
            $fiscalYear->update([
                'status' => 0,
            ]);
        }
        FiscalYear::where('id', $id)->first()->update([
            'status' => 1,
        ]);
        return redirect()->back();
    }
}
