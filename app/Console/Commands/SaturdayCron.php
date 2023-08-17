<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\Employee;
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

        $this->info('success');

        if ($date['weekday'] == 5) {

            foreach (Employee::get() as $employee) {
                $timezone = new DateTimeZone('Asia/Kathmandu'); // Set the Nepali time zone
                $current_time = new DateTime('now', $timezone); // Get the current time in the specified time zone

                $time = $current_time->format('H:i:s'); // Display the current time
                $MyDate=$date['year']."-".$date['month']."-".$date['day'];
                    $data['organization_id'] = $employee->organization_id;
                    $data['branch_id'] = $employee->branch_id;
                    $data['employee_id'] = $employee->id;
                    $data['attendance'] = "S";
                    $data['date'] = $MyDate;
                    $data['inTime'] = "20";
                    $data['outTime'] = "20";
                    $data['workHour'] = "1";
                    $data['salary'] = "1";

                    // if(!Attendance::where('employee_id',$employee->id)->whereDate('date',$MyDate)->first){
                        Attendance::create($data);
                    // }


                $this->info('success');
            }
        }
    }
}
