<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Shankhadev\Bsdate\BsdateController;
use Bsdate;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        if (Auth()->user()->roles[0]->name=="super-admin") {
            return redirect()->back()->with('error',"You are not authorised.");
        } else{
            $attendance = Attendance::where('employee_id', Auth()->user()->employee->id)->first();
            $attendances = Attendance::where('employee_id', Auth()->user()->employee->id)->latest()->get();
        }


        return view('attendance.index', compact('attendance', 'attendances'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => 'required',
        ]);

        $timezone = new DateTimeZone('Asia/Kathmandu'); // Set the Nepali time zone
        $current_time = new DateTime('now', $timezone); // Get the current time in the specified time zone

        $time = $current_time->format('H:i:s'); // Display the current time

        $data['organization_id'] = orgId();
        $data['branch_id'] = Auth()->user()->employee->branch_id;
        $data['employee_id'] = Auth()->user()->employee->id;
        $data['attendance'] = "P";
        $data['date'] = $request->year . "-" . $request->month . "-" . $request->day;
        $data['inTime'] = $time;

        Attendance::create($data);

        return redirect()->back()->with('success', "Present");
    }

    public function update($id)
    {
        $atendance=Attendance::where('id', $id)->first();

        $timezone = new DateTimeZone('Asia/Kathmandu'); // Set the Nepali time zone
        $current_time = new DateTime('now', $timezone); // Get the current time in the specified time zone

        $time = $current_time->format('H:i:s'); // Display the current time

        $data['outTime']=$time;

        $startTime = new DateTime($atendance->inTime);
        $endTime = new DateTime($time);

        $interval = $startTime->diff($endTime);
        $hours = $interval->h; // Hours
        $minutes = $interval->i; // Minutes
        $seconds = $interval->s; // Seconds

        $totalHours = $hours + ($minutes / 60) + ($seconds / 3600);
        $totalHours=number_format($totalHours,2);

        $data['workHour']=$totalHours;

        $employee= Employee::where('id',Auth()->user()->employee->id)->first();

        $data['salary']=$totalHours*$employee->per_hour_salary;

        $atendance->update($data);

        return redirect()->back()->with('success',"Out");


    }


}
