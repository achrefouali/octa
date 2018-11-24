<?php
/**
 * Created by PhpStorm.
 * User: aymen
 * Date: 27/10/18
 * Time: 19:02
 */

namespace App\Utils;


class DateUtils
{


    public static function numberDaysBetween($startDate, $endDate): int
    {
        $number = 0;
        if(!($startDate instanceof \DateTime)){
            $startDate = new \DateTime($startDate);
        }
        if(!($endDate instanceof \DateTime)){
            $endDate = new \DateTime($endDate);
        }

        $diffDays = $endDate->diff($startDate)->format("%a");

        if($diffDays > 0) $number = $diffDays;

        return $number;
    }

}