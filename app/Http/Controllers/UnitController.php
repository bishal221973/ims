<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index(Unit $unit)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }

        // return $orgId;
        $units = Unit::where('organization_id', $org_id)->latest()->get();
        return view('configuration.unit', compact('units', 'unit'));
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'name' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Unit::create($data);

        return redirect()->back()->with('success', "New unit saved.");
    }

    public function edit($id)
    {
        $orgId=orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $unit = Unit::where('id', $id)->where('organization_id', $orgId)->first();

        if ($unit) {
            $units = Unit::where('organization_id', $orgId)->latest()->get();
            return view('configuration.unit', compact('units', 'unit'));
        }
        return redirect()->back()->with('error', "No data found");
    }


    public function update(Unit $unit, Request $request)
    {
        $unit->update($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('unit.index')->with('success', "Unit update");
    }

    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Unit::where('id', $id)->where('organization_id', $org_id)->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('unit.index')->with('success', "Unit removed");
    }
}
