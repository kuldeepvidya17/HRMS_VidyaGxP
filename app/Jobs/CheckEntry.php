<?php

namespace App\Jobs;

use App\Mail\LateEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\IclockTransaction;
use App\Models\LateEntryNotice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckEntry implements ShouldQueue
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
        $entered_employees = IclockTransaction::whereDate('punch_time', Carbon::today())->where('punch_state', 1)->select('emp_code')->distinct()->get();

        $max_allowed_time = Carbon::today()->setTime(9, 10, 0);

        info('running job');

        foreach ($entered_employees as $employee)
        {
            $first_punch_in = IclockTransaction::whereDate('punch_time', Carbon::today())
                                ->where([
                                    'emp_code' => $employee->emp_code,
                                    'punch_state' => 1
                                ])->first();

            $punch_time = Carbon::parse($first_punch_in->punch_time);

            if ($punch_time->gt($max_allowed_time))
            {
                $late_entry_mail_sent = LateEntryNotice::whereDate('created_at', today())->where('emp_code', $employee->emp_code)->first();
                if (!$late_entry_mail_sent)
                {
                    $notice = new LateEntryNotice();
                    $notice->emp_code = $employee->emp_code;
                    $notice->save();
                    Mail::to($first_punch_in->employee->email)->send(new LateEntry($first_punch_in->employee->first_name));
                }
            }
        }
    }
}
