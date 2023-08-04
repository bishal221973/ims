<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Province $province)
    {
        $org_id = orgId();
        $countries = Country::where('organization_id', $org_id)->latest()->get();
        $provinces = Province::where('organization_id', $org_id)->with(['country'])->latest()->get();
        return view('place.province', compact('province', 'provinces', 'countries'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization.");
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
            return redirect()->back()->with('error', "Please select an organization.");
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
        $data = Province::where('id', $id)->where('organization_id', orgId())->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('province.index')->with('success',"Province removed");
    }
}
