<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        $org_id=orgId();
        $schedule=new Schedule;
        $branches=Branch::where('organization_id',$org_id)->latest()->get();
        $schedules=Schedule::with('branch','employee.user')->where('organization_id',$org_id)->latest()->get();
        return view('schedule.index',compact('branches','schedules','schedule'));
    }

    public function getEmployee($id){
        $employees=Employee::with('user')->where('branch_id',$id)->latest()->get();

        return response()->json([
            'data'=>$employees,
        ]);
    }

    public function store(Request $request){
        $data=$request->validate([
            'branch_id'=>'required',
            'employee_id'=>'required',
            'in_time'=>'required',
            'out_time'=>'required',
        ]);
        $data['organization_id']=orgId();

        $schedule=Schedule::where('employee_id',$request->employee_id)->first();

        if($schedule){
            return redirect()->back()->with('error',"Emploee schedule already exist");
        }

        Schedule::create($data);
        return redirect()->back()->with('success',"Saved");
    }

    public function edit($id){
        $org_id=orgId();
        $schedule=Schedule::where('id',$id)->first();
        $branches=Branch::where('organization_id',$org_id)->latest()->get();
        $schedules=Schedule::with('branch','employee.user')->where('organization_id',$org_id)->latest()->get();
        return view('schedule.index',compact('branches','schedules','schedule'));
    }

    public function update(Request $request,$id){
        $data=$request->validate([
            'branch_id'=>'required',
            'in_time'=>'required',
            'out_time'=>'required',
        ]);
        Schedule::find($id)->update($data);

        return redirect()->route('schedule.index')->with('success',"Selected record updated");
    }

    public function delete($id){
        $data = Schedule::where('id', $id)->where('organization_id', orgId())->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('schedule.index')->with('success', "Record removed");
    }
}
