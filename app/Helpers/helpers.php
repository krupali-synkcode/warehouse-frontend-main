<?php

use App\Repositories\WarehouseRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('response_array')) {
    function response_array($type = 'warning', $message = 'no message found')
    {
        return [
            'type' => $type,
            'message' => $message,
        ];
    }
}

if (!function_exists('response_json_array')) {
    function response_json_array($type = 'warning', $message = 'no message found', $data = '')
    {
        return [
            'code' => ($type == 'success') ? 200 : 400,
            'type' => $type,
            'message' => $message,
            'data' => $data,
        ];
    }
}

if (!function_exists('is_valid_uuid')) {
    function is_valid_uuid($string)
    {
        return Str::isUuid($string);
    }
}

// No of days calculation
if (!function_exists('calculate_days')) {
    function calculate_days($date1, $date2)
    {
        $date1 = Carbon::parse($date1)->format('Y-m-d');
        $date2 = Carbon::parse($date2)->format('Y-m-d');
        $carbonDate1 = Carbon::createFromFormat("Y-m-d", $date1);
        $carbonDate2 = Carbon::createFromFormat("Y-m-d", $date2);
        return $carbonDate1->diffInDays($carbonDate2) + 1;
    }
}
