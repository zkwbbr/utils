<?php

declare(strict_types=1);

namespace MyApp\Utils;

class AdjustDateTimeRelatively
{
    /**
     * Wrapper for strtotime
     *
     * @param string $srcDatetime
     * @param string $adjustment (e.g., +1 year)
     * @param string $format standard date formats, if null returns unix timestamp format
     * @return string
     */
    public static function x(string $srcDatetime, string $adjustment, string $format = null): string
    {
    	// mbr note
    	throw new \Error('this function is not yet complete');

        // if date is YYYY-MM-DD H:i:s
        if (false !== strpos($srcDatetime, '-') && false !== strpos($srcDatetime, ':')) {
            list($date, $time) = explode(' ', $srcDatetime);
            list($year, $month, $day) = explode('-', $date);
            list($hour, $minute, $second) = explode(':', $time);

            $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

            $strtotime = strtotime($adjustment, $timestamp);
        }

        // other date formats to be added later e.g., YYYY-MM-DD, MM/DD/YYYY

        return (is_null($format)) ? $strtotime : date($format, $strtotime);
    }

    // ------------------------------------------------
}
