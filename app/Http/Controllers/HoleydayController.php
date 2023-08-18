<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Holeyday;
use DateTime;
use Illuminate\Http\Request;

class HoleydayController extends Controller
{
    public function index()
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $holeydayes = Holeyday::where('organization_id', $org_id)->latest()->get();
        $branchs = Branch::where('organization_id', $org_id)->latest()->get();
        return view('attendance.holeyday', compact('branchs', 'holeydayes'));
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'branch_id' => 'required',
            'from' => 'required',
            'to' => 'required',
            'type' => 'required',
        ]);

        $data['organization_id'] = $org_id;
        Holeyday::create($data);
        return redirect()->back()->with('success', "Saved");
    }
}
