<?php

function readableDate($date, $type = null): ?string
{
    if ($date) {
        $date = strtotime($date);
        if ($type == 'all') {
            return date('F d, Y h:i a', $date);
        } else if ($type == 'y') {
            return date('Y', $date);
        } else if ($type == 'ym') {
            return date('F Y', $date);
        } else if ($type == 'ymd') {
            return date('F d, Y', $date);
        } else if ($type == 'mf') {
            return date('F  h:i a', $date);
        } else if ($type == 'md') {
            return date('F d', $date);
        } else if ($type == 'fdt') {
            return date('F d, h:i a', $date);
        } else if ($type == 'dt') {
            return date('d, h:i a', $date);
        } else if ($type == 'time') {
            return date('h:i a', $date);
        } else if ($type == 'date') {
            return date('Y-m-d', $date);
        }
    }
    return null;
}


if (!function_exists('showNotification')) {
    function showNotification($message, $type = 'success')
    {
        drakify($type);
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $value = \App\Models\Setting::where('key', $key)->first();
        if (!$value)
            return null;
        else
            return $value->value;
    }
}

if (!function_exists('getTimeFromSeconds')) {
    function getTimeFromSeconds($duration_in_seconds)
    {
        return gmdate('H:i:s', $duration_in_seconds);
    }
}
