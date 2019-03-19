<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class AdjustedDateTimeByTimeZone
{

    /**
     * Adjust timezone of date. This assumes you store dates in UTC
     *
     * @param string $srcDateTime for format info refer to http://www.php.net/manual/en/datetime.formats.php Tip: You can use 'now' value.
     * @param string $newTimezone supported timezones: http://php.net/manual/en/timezones.php
     * @param string $format
     * @return string
     */
    public static function x(string $srcDateTime = 'now', string $newTimezone, string $format): string
    {
        $dateTime = new \DateTime($srcDateTime);
        $newTimezone = new \DateTimeZone($newTimezone);
        $dateTime->setTimezone($newTimezone);

        return $dateTime->format($format);
    }
}
