<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

if (!function_exists('pre')) {
    function pre($data)
    {
        echo "<pre>";
        if (is_object($data)) {
            $data = $data->toArray();
        }
        print_r($data);
        echo "</pre>";

    }
}

if (!function_exists('date_ymd')) {

    function date_ymd($date)
    {

        if ($date != "") {
            $date = str_replace('/', '-', $date);
            $date = date("Y-m-d", strtotime($date));
        } else {
            $date = NULL;
        }

        return $date;
    }
}

if (!function_exists('date_dmy')) {

    function date_dmy($date)
    {
        if ($date != "") {
            $date = date("d-m-Y", strtotime($date));
        } else {
            $date = NULL;
        }
        return $date;
    }
}

if (!function_exists('date_dmy_dp')) {

    function date_dmy_dp($date)
    {
        if ($date != "") {
            $date = date("d/m/Y", strtotime($date));
        } else {
            $date = NULL;
        }
        return $date;
    }
}

if (!function_exists('date_dmy_to_ymd')) {
    function date_dmy_to_ymd($date)
    {
        if($date != ""){
            $dateEx = explode('/', $date);
            $month = $dateEx[1];
            $day = $dateEx[0];
            $year = $dateEx[2];
            $stringDate = $day . "-" . $month . "-" . $year;
            $formated_date = date("Y-m-d", strtotime($stringDate));
            return $formated_date;
        }else{
            return NULL;
        }

    }
}

function customReturn($p) {
    // Check if $p is an integer or has decimal places
    if ($p != "" && (is_int($p) || $p == floor($p))) {
        // Return the integer part
        return floor($p);
    } else {
        // Return the value as it is
        return $p;
    }
}


if (!function_exists('yearList')) {

    function yearList()
    {
        $startYear = 2022;
        $currentYear = date('Y');
        $yearList = array_reverse(range($startYear, $currentYear));
        return $yearList;
    }
}

function getStartAndEndDate($startMonth, $endMonth, $year)
{
    // Get the first date of the start month
    $startDate = Carbon::create($year, $startMonth, 1)->startOfMonth()->toDateString();

    // Get the last date of the end month
    $endDate = Carbon::create($year, $endMonth, 1)->endOfMonth()->toDateString();

    return [
        'start_date' => $startDate,
        'end_date' => $endDate,
    ];
}

function getSubMonthsNewDate($startMonth, $months)
{
    $date = Carbon::parse($startMonth); // Given date
    $newDate = $date->subMonths($months); // Subtract 3 months
    return $newDate->format('Y-m-d');
}

if (!function_exists('expiryDate')) {
    function expiryDate($date,$months)
    {
        if ($date != "" && $months != "") {
            $date = new DateTime($date);
            $date->modify("+$months months");
            $expiry_date = $date->format('Y-m-d');
        } else {
            $expiry_date = $date;
        }
        return $expiry_date;
    }
}


if (!function_exists('sendEmail')) {
    function sendEmail($to, $subject, $content, $data = [], $cc = [], $bcc = [], $attachments = [])
    {
        try {
            // Render the view content to a string if necessary
            if ($content instanceof Illuminate\View\View) {
                $content = $content->render();
            } elseif (is_string($content)) {
                $content = View::make($content, $data)->render();
            }

            Mail::send([], $data, function ($message) use ($to, $subject, $content, $cc, $bcc, $attachments) {
                $message->to($to)
                    ->subject($subject);

                // Set the body content as HTML
                $message->html($content); // For HTML content

                // Add CC recipients if any
                if (!empty($cc)) {
                    $message->cc($cc);
                }

                // Add BCC recipients if any
                if (!empty($bcc)) {
                    $message->bcc($bcc);
                }

                // Attach files if any
                foreach ($attachments as $attachment) {
                    $message->attach($attachment);
                }
            });
           // CommonDataModel::insertNotificationLogData('E', strip_tags($subject), $to);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage(); // Return the exception message for debugging
        }
    }
}

if (!function_exists('vasset')) {
    function vasset($path) {
        $file = public_path($path);

        if (file_exists($file)) {
            return asset($path) . '?v=' . filemtime($file);
        }

        return asset($path);
    }
}



if (!function_exists('getTimeFromDate')) {
    function getTimeFromDate($date) {
        return Carbon::parse($date)->format('h:i A');
    }
}

