<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index()
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $employees = Employee::where('organization_id', $org_id)->with(['user', 'branch'])->latest()->get();
        return view('employee.employeeList', compact('employees'));
    }
    public function create(Employee $employee)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        $countries = Country::where('organization_id', $org_id)->latest()->get();
        $provinces = Province::where('organization_id', $org_id)->latest()->get();
        $roles = Role::select('id', 'name')->where('organization_id', $org_id)->get();
        return view('employee.employee', compact('countries', 'provinces', 'employee', 'branches', 'roles'));
    }

    public function store(Request $request)
    {
        // return $request->role;
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        // $org = Organization::select('id')->where('admin_id', $admin_id)->first();
        $userData = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
            // 'role'=>'required',
        ]);
        if ($request->file('image')) {
            $userData['image'] = $request->file('image')->store();
        }
        $userData['password'] = Hash::make($request->password);
        // $userData['organization_id'] = $org->id;

        $empData = $request->validate([
            'country_id' => 'nullable',
            'province_id' => 'nullable',
            'joining_date' => 'nullable',
            'salary' => 'required',
            'branch_id' => 'required',
        ]);
        $empData['organization_id'] = $org_id;

        $user = User::create($userData);
        $empData['user_id'] = $user->id;

        Employee::create($empData);

        if ($request->role) {
            foreach ($request->role as $role) {
                $user->assignRole($role);
            }
        }


        return redirect()->back()->with('success', "New employee registered.");
    }

    public function edit(Employee $employee)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }

        $employee = Employee::where('organization_id', $org_id)->where('id', $employee->id)->first();

        if (!$employee) {
            return redirect()->back()->with('error', "Data not found");
        }

        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        $countries = Country::where('organization_id', $org_id)->latest()->get();
        $provinces = Province::where('organization_id', $org_id)->latest()->get();
        $roles = Role::select('id', 'name')->where('organization_id', $org_id)->get();
        return view('employee.employee', compact('countries', 'provinces', 'employee', 'branches', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {

        $empData = $request->validate([
            'country_id' => 'nullable',
            'province_id' => 'nullable',
            'joining_date' => 'nullable',
            'salary' => 'required',
            'branch_id' => 'required',
        ]);

        $employee->update($empData);
        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'nullable',
            'dob' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'image' => 'nullable',
        ]);
        if ($request->file('image')) {
            $userData['image'] = $request->file('image')->store();
        }
        User::where('id', $employee->user_id)->first()->update($userData);
        return redirect()->route('employee.index')->with('success', "Selected employee updated.");
    }

    public function delete(Employee $employee)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Employee::where('id', $employee->id)->where('organization_id', $org_id)->first();

        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', "Selected employee removed.");
        }
        return redirect()->back()->with('error', "Data not found.");
    }
}
