<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Brand $brand)
    {
        return ad_to_bs(today());
        $orgId = orgId();
        $brands = Brand::where('organization_id', $orgId)->latest()->get();
        return view('product.brand', compact('brands', 'brand'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization.");
        }
        $data = $request->validate([
            'name' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Brand::create($data);

        return redirect()->back()->with('success', "New brand saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization.");
        }
        $brand = Brand::where('id', $id)->where('organization_id', $orgId)->first();

        if ($brand) {
            $brands = Brand::where('organization_id', $orgId)->latest()->get();
            return view('product.brand', compact('brands', 'brand'));
        }
        return redirect()->back()->with('error', "No data found");
    }


    public function update(Brand $brand, Request $request)
    {
        $brand->update($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('brand.index')->with('success', "Brand update");
    }

    public function delete($id)
    {
        $data = Brand::where('id', $id)->where('organization_id', orgId())->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->back()->with('success', "Brand removed");
    }
}
