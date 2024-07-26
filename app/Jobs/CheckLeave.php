<?php

namespace App\Jobs;

use App\Mail\LeaveMail;
use App\Models\EmployeeLeave;
use App\Models\IclockTransaction;
use App\Models\PersonnelEmployee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CheckLeave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $employees = PersonnelEmployee::get();

        $is_sunday = today()->format('D') == 'Sun';

        if (!$is_sunday) 
        {
            foreach ($employees as $employee)
            {
                $transaction_entry = IclockTransaction::whereDate('punch_time', today())->where('emp_code', $employee->emp_code)->first();
    
                if (!$transaction_entry)
                {
                    $emp_leave_record = EmployeeLeave::whereDate('created_at', today())->where('emp_code', $employee->emp_code)->first();
                    if (!$emp_leave_record)
                    {
                        $leave_record = new EmployeeLeave();
                        $leave_record->emp_code = $employee->emp_code;
                        $leave_record->save();
                        try{
                            Mail::to($employee->email)->send(new LeaveMail($employee->first_name));
                        } catch (\Exception $e)
                        {
                            info($e->getMessage());
                        }
                    }
                }
            }
        }

        
    }
}
