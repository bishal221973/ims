<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index(LeaveType $leaveType)
    {
        $org_id=orgId();
        $leaveTypes=LeaveType::where('organization_id',$org_id)->latest()->get();
        return view('leave.type', compact('leaveType','leaveTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
        ]);
        $org_id=orgId();
        if(!$org_id){
            return redirect()->back()->with('error',"Please Select an Organization");
        }
        $type = LeaveType::where('type', $request->type)->where('organization_id', $org_id)->first();
        if ($type) {
            return redirect()->back()->with('success', "Leave type already exist");
        }
        $data['organization_id']=$org_id;
        LeaveType::create($data);
        return redirect()->back()->with('success', "Saved");
    }

    public function edit($id){
        $org_id=orgId();
        $leaveType=LeaveType::where('id',$id)->first();
        $leaveTypes=LeaveType::where('id',$org_id)->latest()->get();
        return view('leave.type', compact('leaveType','leaveTypes'));
    }

    public function update(Request $request,$id){
        $data = $request->validate([
            'type' => 'required',
        ]);
        LeaveType::where('id',$id)->first()->update($data);

        return redirect()->route('leaveType.index')->with('success',"Selected leave type updated");
    }

    public function delete($id){
        $data = LeaveType::where('id', $id)->where('organization_id', orgId())->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('leaveType.index')->with('success', "Record removed");
    }
}
