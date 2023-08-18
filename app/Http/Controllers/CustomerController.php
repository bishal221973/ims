<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Customer $customer){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $countries=Country::where('organization_id',$org_id)->latest()->get();
        $provinces=Province::where('organization_id',$org_id)->latest()->get();
        $branches=Branch::where('organization_id',$org_id)->latest()->get();
        $customers=Customer::where('organization_id',$org_id)->with(['country','province','branch'])->latest()->get();
        return view('sales.customer',compact('customer','customers','countries','provinces','branches'));
    }

    public function store(Request $request)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }

        $data = $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'vat_number' => 'nullable|numeric',
            'country_id' => 'nullable',
            'province_id' => 'nullable',
            'branch_id' => 'required',
        ]);


        $data['organization_id'] = $org_id;

        if (Customer::where('organization_id', $org_id)->where('phone', $request->phone)->first()) {
            return redirect()->back()->with('error', "Supplier already exists.");
        }
        Customer::create($data);

        return redirect()->back()->with('success', "New customer saved.");
    }

    public function edit($id)
    {
        $orgId = orgId();
        if (!$orgId) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $customer = Customer::where('id', $id)->where('organization_id', $orgId)->first();

        if ($customer) {
            $countries=Country::where('organization_id',$orgId)->latest()->get();
            $provinces=Province::where('organization_id',$orgId)->latest()->get();
            $branches=Branch::where('organization_id',$orgId)->latest()->get();
            $customers=Customer::where('organization_id',$orgId)->with(['country','province','branch'])->latest()->get();
            return view('sales.customer',compact('customer','customers','countries','provinces','branches'));


        }
        return redirect()->back()->with('error', "No data found");
    }

    public function update(Customer $customer, Request $request)
    {
        $customer->update($request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'vat_number' => 'nullable|numeric',
            'country_id' => 'nullable',
            'province_id' => 'nullable',
            'branch_id' => 'required',
        ]));

        return redirect()->route('customer.index')->with('success', "Customer update");
    }

    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Customer::where('id', $id)->where('organization_id', $org_id)->first();

        if(!$data){
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('customer.index')->with('success',"Customer removed");
    }
    public function filterCustomer($number)
    {
        $customer = Customer::with('province.country')->where('phone', $number)->where('organization_id', orgId())->first();
        return response()->json([
            'data' => $customer
        ]);
    }
}
