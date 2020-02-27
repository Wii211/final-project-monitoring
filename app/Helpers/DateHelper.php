<?php

namespace App\Helpers;

use Carbon\Carbon;


class DateHelper
{
    public function getTodayDate()
    {
        return $this->formatDate(Carbon::now());
    }

    public function formatDate($date)
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        return $date->formatLocalized('%d ') . $this->convertMonthName($date->formatLocalized("%m")) . $date->formatLocalized(" %Y");
    }

    public function formatDateWithDayName($date)
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        
        return $date->formatLocalized("%A, %d ") .  $this->convertMonthName($date->formatLocalized('%m'))  .  $date->formatLocalized(" %Y");
    }

    public static function convertTimeHour($time)
    {
        return date('H:i', strtotime($time));
    }
    
    public function convertMonthName($monthNumeric):String{
        $month=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        
        return $month[intval($monthNumeric)];
    }
}
