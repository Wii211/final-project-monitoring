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

        return $date->formatLocalized('%d %B %Y');
    }
}
