<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Leave;
use App\Models\LeaveType;
use DateTime;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'mailVerify']);
    }
    public function index(Leave $leave)
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $leaveTypes = LeaveType::where('organization_id', $org_id)->latest()->get();
        $leaves=Leave::where('organization_id',$org_id)->latest()->get();
        return view('leave.index', compact('leave', 'leaveTypes','leaves'));
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required',
        ]);

        $data['leaveType']="Not Defined";

        $data['organization_id'] = orgId();
        $startDate = new DateTime($request->from);
        $endDate = new DateTime($request->to);

        $interval = $startDate->diff($endDate);
        $daysDifference = $interval->days;
        $data['day'] = $daysDifference + 1;
        // if (Auth()->user()->roles[0]->name != "admin") {
            $data['branch_id'] = Auth()->user()->employee->branch_id;
        // }

        Leave::create($data);

        return redirect()->back()->with('success', "Successfully apply for leave.");
    }

    public function edit(Leave $leave){
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $leaveTypes = LeaveType::where('organization_id', $org_id)->latest()->get();
        $leaves=Leave::where('organization_id',$org_id)->latest()->get();
        return view('leave.index', compact('leave', 'leaveTypes','leaves'));
    }

    public function update(Request $request,Leave $leave){
        $data = $request->validate([
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required',
        ]);

        $leave->update($data);

        return redirect()->route('leave.index')->with('success',"Updated");
    }

    public function delete(Leave $leave){
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Leave::where('id', $leave->id)->where('organization_id', $org_id)->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('leave.index')->with('success', "Record removed");
    }
    public function list()
    {
        $org_id = orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $branch= Branch::where('organization_id',$org_id)->where('branch_name','Main Branch')->first();
        $leaves=Leave::where('organization_id',$org_id)->where('branch_id',$branch->id)->latest()->get();
        return view('leave.list', compact('leaves'));
    }

    public function statusAccept(Request $request,$id){

        Leave::where('id',$id)->first()->update([
            'status'=>'Accepted',
        ]);



        return redirect()->route('leave.list')->with('success', "Accepted");
    }

    public function statusReject($id){
        Leave::where('id',$id)->first()->update([
            'status'=>'Rejected',
        ]);

        return redirect()->route('leave.list')->with('success', "Rejected");
    }
}
