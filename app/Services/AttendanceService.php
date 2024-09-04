<?php 

namespace App\Services;

use App\Models\IclockTransaction;
use App\Models\PersonnelEmployee;
use App\Mail\DailyReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AttendanceService
{
    static function daily_report()
    {
        $employees = PersonnelEmployee::get();

        $reports = [];

        $is_sunday = today()->format('D') == 'Sun';

        if(!$is_sunday) 
        {
           
        //    $duplicateIds = [
        //     '$2y$10$anxacMmakMzbuzAe5GB9quomrUanuPjgqv1JMgwwRYZjRaMKWNu1W',
        //     '$2y$10$/W/5UU5JH1/oFbn2kku9N.Udei6TJewCtUi4TTYVbQPkLJBJZ1Wh6'
        //    ];

            foreach ($employees as $employee)
            {
                try {
                    $status = 'Present';

                    $first_punch_in = IclockTransaction::whereDate('punch_time', Carbon::today())
                                    ->where([
                                        'emp_code' => $employee->emp_code,
                                        'punch_state' => 0
                                    ])->orderBy('id', 'asc')->first();
                    $last_punch_out = IclockTransaction::whereDate('punch_time', Carbon::today())
                                        ->where([
                                            'emp_code' => $employee->emp_code,
                                            'punch_state' => 1
                                        ])->orderBy('id', 'desc')->first();

                    if (!$first_punch_in && !$last_punch_out)
                    {
                        $status = 'Absent';
                    }

                    $is_present = $status == "Present";
        
                    $punch_in_time = $is_present ? Carbon::parse($first_punch_in->punch_time) : $status;
                    $punch_out_time = $is_present ? Carbon::parse($last_punch_out->punch_time) : $status;

                    array_push($reports, [
                        'emp_code' => $employee->emp_code,
                        'name' => $employee->first_name . ' ' . $employee->last_name,
                        'punch_in_time' => $punch_in_time,
                        'punch_out_time' => $punch_out_time,
                        'status' => $status
                    ]);
                } catch (\Exception $e) {
                    // 
                }

            }

            Mail::to('admin@vidyagxp.com')->cc(['anshul.patel@vidyagxp.com'])->send(new DailyReport($reports));
        }

        return count($reports) . ' Reports Sent';
    }
}