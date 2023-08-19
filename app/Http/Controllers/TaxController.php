<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index(Tax $tax)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $taxs = Tax::where('organization_id', $org_id)->latest()->get();

        return view('configuration.tax', compact(['tax', 'taxs']));
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Tax::create($data);

        return redirect()->back()->with('success', "New unit saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $tax = Tax::where('id', $id)->where('organization_id', $orgId)->first();

        if ($tax) {
            $taxs = tax::where('organization_id', $orgId)->latest()->get();
            return view('configuration.tax', compact('taxs', 'tax'));
        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Tax $tax, Request $request)
    {
        $tax->update($request->validate([
            'name' => 'required',
            'value' => 'required',
        ]));

        return redirect()->route('tax.index')->with('success', "Tax update");
    }

    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Tax::where('id', $id)->where('organization_id', $org_id)->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('tax.index')->with('success', "Tax removed");
    }
}
