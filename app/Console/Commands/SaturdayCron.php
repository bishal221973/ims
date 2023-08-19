<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Holeyday;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SaturdayCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $carbonInstance = Carbon::now();

        $year = $carbonInstance->year;    // Get the year as an integer
        $month = $carbonInstance->month;  // Get the month as an integer
        $day = $carbonInstance->day;
        $date = ad_to_bs($year, $month, $day);




        // DB::table('attendances')->insert($data);
        // Attendance::create($data);



        foreach (Employee::get() as $employee) {
            $MyDate = $date['year'] . "-" . $date['month'] . "-" . $date['day'];

            $leave = Leave::where('branch_id', $employee->branch_id)->whereDate('from', '<=', $MyDate)->whereDate('to', '>=', $MyDate)->where('status', 'Accepted')->first();
            if ($leave) {
                $timezone = new DateTimeZone('Asia/Kathmandu'); // Set the Nepali time zone
                $current_time = new DateTime('now', $timezone); // Get the current time in the specified time zone

                $attendance=Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first();

                if($attendance){
                    $attendance->delete();
                }

                $time = $current_time->format('H:i:s'); // Display the current time
                $data['organization_id'] = $employee->organization_id;
                $data['branch_id'] = $employee->branch_id;
                $data['employee_id'] = $employee->id;
                $data['attendance'] = "L";
                $data['date'] = $MyDate;
                $data['inTime'] = "0";
                $data['outTime'] = "0";
                $data['workHour'] = "0";

                $data['salary'] = "0";
                // if(!Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first){
                Attendance::create($data);
            }
        }


        foreach (Employee::get() as $employee) {
            $MyDate = $date['year'] . "-" . $date['month'] . "-" . $date['day'];

            $holeyday = Holeyday::where('branch_id', $employee->branch_id)->whereDate('from', '<=', $MyDate)->whereDate('to', '>=', $MyDate)->first();

            if ($holeyday) {

                $attendance=Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first();

                if($attendance){
                    $attendance->delete();
                }
                $timezone = new DateTimeZone('Asia/Kathmandu'); // Set the Nepali time zone
                $current_time = new DateTime('now', $timezone); // Get the current time in the specified time zone

                $time = $current_time->format('H:i:s'); // Display the current time
                $data['organization_id'] = $employee->organization_id;
                $data['branch_id'] = $employee->branch_id;
                $data['employee_id'] = $employee->id;
                $data['attendance'] = "H";
                $data['date'] = $MyDate;
                $data['inTime'] = "0";
                $data['outTime'] = "0";
                $data['workHour'] = "0";
                if ($holeyday->type == "Paid") {

                    $data['salary'] = $employee->salary / 30;
                } else {
                    $data['salary'] = "0";
                }
                // if(!Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first){
                Attendance::create($data);
            }
        }

        if ($date['weekday'] == 7) {

            foreach (Employee::get() as $employee) {
                $MyDate = $date['year'] . "-" . $date['month'] . "-" . $date['day'];
                $attendance=Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first();

                if($attendance){
                    $attendance->delete();
                }
                $timezone = new DateTimeZone('Asia/Kathmandu'); // Set the Nepali time zone
                $current_time = new DateTime('now', $timezone); // Get the current time in the specified time zone

                $time = $current_time->format('H:i:s'); // Display the current time
                $data['organization_id'] = $employee->organization_id;
                $data['branch_id'] = $employee->branch_id;
                $data['employee_id'] = $employee->id;
                $data['attendance'] = "S";
                $data['date'] = $MyDate;
                $data['inTime'] = "0";
                $data['outTime'] = "0";
                $data['workHour'] = "0";
                $data['salary'] = $employee->salary;

                // if(!Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first){
                Attendance::create($data);
                // }


                $this->info('success');
            }
        }
    }
}
