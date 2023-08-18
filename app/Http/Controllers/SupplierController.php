<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Province;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Supplier $supplier)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $countries = Country::where('organization_id', $org_id)->latest()->get();
        $provinces = Province::where('organization_id', $org_id)->latest()->get();
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        $suppliers = Supplier::where('organization_id', $org_id)->with(['country', 'province', 'branch'])->latest()->get();
        return view('purchase.supplier', compact('supplier', 'suppliers', 'countries', 'provinces', 'branches'));
    }


    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }

        $data = $request->validate([
            'name' => 'required',
            'branch_id' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'vat_number' => 'required|numeric',
            'country_id' => 'nullable',
            'province_id' => 'nullable',
        ]);


        $data['organization_id'] = $org_id;

        if (Supplier::where('organization_id', $org_id)->where('phone', $request->phone)->first()) {
            return redirect()->back()->with('error', "Supplier already exists.");
        }
        Supplier::create($data);

        return redirect()->back()->with('success', "New supplier saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $supplier = Supplier::where('id', $id)->where('organization_id', $orgId)->first();

        if ($supplier) {
            $countries = Country::where('organization_id', $orgId)->latest()->get();
            $provinces = Province::where('organization_id', $orgId)->latest()->get();
            $branches = Branch::where('organization_id', $orgId)->latest()->get();
            $suppliers = Supplier::where('organization_id', $orgId)->with(['country', 'province', 'branch'])->latest()->get();
            return view('purchase.supplier', compact('supplier', 'suppliers', 'countries', 'provinces', 'branches'));
        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Supplier $supplier, Request $request)
    {
        $supplier->update($request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'vat_number' => 'required|numeric',
            'country_id' => 'nullable',
            'province_id' => 'nullable',
            'branch_id' => 'required',
        ]));

        return redirect()->route('supplier.index')->with('success', "Supplier update");
    }

    public function delete($id)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Supplier::where('id', $id)->where('organization_id', $org_id)->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('supplier.index')->with('success', "Supplier removed");
    }
}
