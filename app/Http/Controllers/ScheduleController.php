<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Schedule;
use DateTime;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $schedule = new Schedule;
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        $schedules = Schedule::with('branch', 'employee.user')->where('organization_id', $org_id)->latest()->get();
        return view('schedule.index', compact('branches', 'schedules', 'schedule'));
    }

    public function getEmployee($id)
    {
        $employees = Employee::with('user')->where('branch_id', $id)->latest()->get();

        return response()->json([
            'data' => $employees,
        ]);
    }

    public function store(Request $request)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = $request->validate([
            'branch_id' => 'required',
            'employee_id' => 'required',
            'in_time' => 'required',
            'out_time' => 'required',
        ]);
        $data['organization_id'] =$org_id;


        $startTime = new DateTime($request->in_time);
        $endTime = new DateTime($request->out_time);

        $interval = $startTime->diff($endTime);
        $hours = $interval->h; // Hours
        $minutes = $interval->i; // Minutes
        $seconds = $interval->s; // Seconds

        $totalHours = $hours + ($minutes / 60) + ($seconds / 3600);
        $totalHours=number_format($totalHours,2);

        $emp=Employee::where('id',$request->employee_id)->first();

        $dailySalary=$emp->salary/30;

        $emp->update([
            'working_time'=>$totalHours,
            'per_hour_salary'=>$dailySalary/$totalHours,
        ]);


        $schedule = Schedule::where('employee_id', $request->employee_id)->first();

        if ($schedule) {
            return redirect()->back()->with('error', "Emploee schedule already exist");
        }

        Schedule::create($data);
        return redirect()->back()->with('success', "Saved");
    }

    public function edit($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $schedule = Schedule::where('id', $id)->first();
        $branches = Branch::where('organization_id', $org_id)->latest()->get();
        $schedules = Schedule::with('branch', 'employee.user')->where('organization_id', $org_id)->latest()->get();
        return view('schedule.index', compact('branches', 'schedules', 'schedule'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'branch_id' => 'required',
            'in_time' => 'required',
            'out_time' => 'required',
        ]);
        Schedule::find($id)->update($data);

        return redirect()->route('schedule.index')->with('success', "Selected record updated");
    }

    public function delete($id)
    {
        $org_id=orgId();
        if (!$org_id) {
            return redirect()->back()->with('error', "Please select an organization before perform any operation on it.");
        }
        $data = Schedule::where('id', $id)->where('organization_id', $org_id)->first();

        if (!$data) {
            return redirect()->back()->with('error', "No data found");
        }
        $data->delete();
        return redirect()->route('schedule.index')->with('success', "Record removed");
    }
}
