<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class FormatDateTime
{

    /**
     * Format datetime string.
     *
     * Supported formats:
     * - YYYY-MM-DD HH:MM:SS
     * - YYYY-MM-DD
     * - MM/DD/YYYY
     *
     * @param string $dateStamp
     * @param string $format
     * @return string
     */
    public static function x(string $dateStamp, string $format = 'M d, Y'): string
    {
        // if date is YYYY-MM-DD HH:MM:SS
        if (false !== strpos($dateStamp, ':')) {
            $p = '~(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})~';
            preg_match($p, $dateStamp, $matches);

            $matches = array_map('intval', $matches);

            $dateStamp = mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]);
        }

        // if date is YYYY-MM-DD
        elseif (false !== strpos($dateStamp, '-')) {
            list($y, $m, $d) = explode('-', $dateStamp);
            $dateStamp = mktime(0, 0, 0, (int) $m, (int) $d, (int) $y);
        }

        // if date is MM/DD/YYYY
        elseif (false !== strpos($dateStamp, '/')) {
            list($m, $d, $y) = explode("/", $dateStamp);
            $dateStamp = mktime(0, 0, 0, (int) $m, (int) $d, (int) $y);
        }

        return date($format, $dateStamp);
    }
}
