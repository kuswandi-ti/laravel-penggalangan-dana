<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('upload')) {
    function upload($directory, $file, $filename = "")
    {
        $extension = $file->getClientOriginalExtension();
        $filename = "{$filename}_" . date('Ymdhis') . ".{$extension}";

        Storage::disk('public')->putFileAs("/$directory", $file, $filename);

        return "/$directory/$filename";
    }
}

if (!function_exists('amount_format_id')) {
    function amount_format_id($amount)
    {
        return number_format((float)$amount, 0, ',', '.');
    }
}

if (!function_exists('date_format_id')) {
    function date_format_id($date, $show_day = true, $show_time = true)
    {
        // $day_name = array(
        //     'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday',
        // );
        $day_name = array(
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu',
        );

        // $month_name = array(
        //     1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
        // );
        $month_name = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        );

        $year_sub = substr($date, 0, 4);
        $month_sub = $month_name[(int) substr($date, 5, 2)];
        $date_sub = substr($date, 8, 2);
        $time_sub = date('H:i', strtotime($date));

        $text = '';

        $sort_day = date('w', mktime(0, 0, 0, substr($date, 5, 2), $date_sub, $year_sub));
        $day = $day_name[$sort_day];

        if ($show_day && $show_time) {
            $text = "$day, $date_sub $month_sub $year_sub $time_sub";
        } else if ($show_time && $show_time == false) {
            $text = "$day, $date_sub $month_sub $year_sub";
        } else if ($show_time == false && $show_time) {
            $text = "$day, $time_sub";
        } else {
            $text = "$date_sub $month_sub $year_sub";
        }

        return $text;
    }
}

if (!function_exists('mounth_format_id')) {
    function mounth_format_id($bulan)
    {
        $nama_bulan = array(
            1 =>
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        return $nama_bulan[(int) $bulan];
    }
}
