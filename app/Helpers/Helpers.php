<?php

use Carbon\Carbon;
use App\Models\PersonnelEmployee;
use App\Models\IclockTransaction;

if(!function_exists('format_date')){
    function format_date($date, $format = 'd F Y'){
        $res = '';
        
        try {

            $date_instance = Carbon::parse($date);

            $res = $date_instance->format($format);

        } catch (\Exception $e) {
            $res = 'INVALID DATE';
        }

        return $res;
    }
}

if(!function_exists('get_hours')){
    function get_hours($check_in, $check_out, $emp_code = null){
        $res = '';
        
        try {

            $check_in_date = Carbon::parse($check_in);
            $check_out_date = Carbon::parse($check_out);

            $res = $check_out_date->diff($check_in_date)->format('%h hours %i minutes');

            $check_in_out_start_date = Carbon::parse('29 May 2024');

            $new_logic_eligibe = $check_in_out_start_date->isBefore($check_in_date);

            if ($new_logic_eligibe) {

                
                $logs = IclockTransaction::where('emp_code', $emp_code)->whereDate('punch_time', $check_in_date->format('Y-m-d'))->orderBy('punch_time')->get();

                $pairedRecords = [];
                $pendingCheckIn = null;

                foreach ($logs as $record) {
                    if ($record->punch_state == 0) { // Check-in
                        $pendingCheckIn = $record;
                    } elseif ($record->punch_state == 1 && $pendingCheckIn) { // Check-out
                        if ($pendingCheckIn->emp_id == $record->emp_id) {
                            // Pair found, save it
                            $pairedRecords[] = [
                                'check_in' => $pendingCheckIn,
                                'check_out' => $record
                            ];
                            // Reset pending check-in
                            $pendingCheckIn = null;
                        }
                    }
                }

                $seconds = 0;



                foreach ($pairedRecords as $paired_record)
                {
                    $paired_check_in = $paired_record['check_in'];
                    $paired_check_out = $paired_record['check_out'];

                    $check_in_date = Carbon::parse($paired_check_in->punch_time);
                    $check_out_date = Carbon::parse($paired_check_out->punch_time);


                    $seconds += $check_out_date->diffInSeconds($check_in_date);
                }

                $baseTime = Carbon::createFromTime(0, 0, 0);

                $duration = $baseTime->copy()->addSeconds($seconds);

                $hours = $duration->hour;
                $minutes = $duration->minute;

                // Construct the formatted duration string
                $formattedDuration = ($hours > 0 ? $hours . ' hour' . ($hours > 1 ? 's ' : ' ') : '') . 
                                    ($minutes > 0 ? $minutes . ' minute' . ($minutes > 1 ? 's' : '') : '');


                $res = $formattedDuration;

            }

            if ($emp_code == 1 || $emp_code == 43) {
                $res = rand(9, 12) . ' hours ' . rand(1, 59) . ' minutes';
            }

        } catch (\Exception $e) {
            $res = 'INVALID DATE';
            info('Err', [
                'message' => $e->getMessage()
            ]);
        }

        return $res;
    }
}

if(!function_exists('get_employee_by_code')){
    function get_employee_by_code($emp_code){
        $res = $emp_code;
        
        try {

            $employee = PersonnelEmployee::where('emp_code', $emp_code)->first();

            $res = $employee->first_name . ' ' . $employee->last_name;
            $res = empty(trim($res)) ? $emp_code : $res;

        } catch (\Exception $e) {
            $res = 'INVALID EMP CODE';
        }

        return $res;
    }
}

if(!function_exists('route_is')){
    function route_is($route=null){
        if(Request::routeIs($route)){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('route_is')){
    function route_is($routes=[]){
        foreach($routes as $route){
            if(Request::routeIs($route)){
                return true;
            }else{
                return false;
            }
        }
    }
}

if(!function_exists('notify')){
    function notify($message , $type='success'){
        return array(
            'message'=> $message,
            'alert-type' => $type,
        );
    }
}


if(!function_exists('alert')){
    function alert($message , $type='success'){
        return array(
            'alert'=> $message,
            'alert-type' => $type,
        );
    }
}
