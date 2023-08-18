<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Country $country)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $countries = Country::where('organization_id', $org_id)->latest()->get();
        return view('place.country', compact('country', 'countries'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'name' => 'required',
        ]);
        $data['organization_id'] = $org_id;
        Country::create($data);

        return redirect()->back()->with('success', "New brand saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $country = Country::where('id', $id)->where('organization_id', $orgId)->first();

        if ($country) {
            $countries = Country::where('organization_id', $orgId)->latest()->get();
            return view('place.country', compact('country', 'countries'));
        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Country $country, Request $request)
    {
        $country->update($request->validate([
            'name' => 'required',
        ]));

        return redirect()->route('country.index')->with('success', "Category update");
    }

    public function delete($id)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Country::where('id', $id)->where('organization_id', $org_id)->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('country.index')->with('success', "Brand removed");
    }
}
