<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Province $province)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $countries = Country::where('organization_id', $org_id)->latest()->get();
        $provinces = Province::where('organization_id', $org_id)->with(['country'])->latest()->get();
        return view('place.province', compact('province', 'provinces', 'countries'));
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'country_id' => 'required',
            'name' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Province::create($data);

        return redirect()->back()->with('success', "New brand saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $province = Province::where('id', $id)->where('organization_id', $orgId)->first();

        if ($province) {
            $countries = Country::where('organization_id', $orgId)->latest()->get();
            $provinces = Province::where('organization_id', $orgId)->with(['country'])->latest()->get();
            return view('place.province', compact('province', 'provinces', 'countries'));
        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Province $province, Request $request)
    {
        $province->update($request->validate([
            'country_id' => 'required',
            'name' => 'required',
        ]));

        return redirect()->route('province.index')->with('success', "Province update");
    }

    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Province::where('id', $id)->where('organization_id', $org_id)->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('province.index')->with('success',"Province removed");
    }

    public function select($id){
        $provinces = Province::where('country_id', $id)->where('organization_id', orgId())->get();
        return response()->json([
            'provinces' => $provinces
        ]);
    }
}
