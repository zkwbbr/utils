<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class AdjustedDateTimeByString
{

    /**
     * Wrapper for strtotime
     *
     * @param string $srcDateTime
     * @param string $adjustment (e.g., +1 year)
     * @param string $format standard date formats, if null, returns unix timestamp format
     * @return string
     */
    public static function x(string $srcDateTime, string $adjustment, string $format = null): string
    {
        $srcTimestamp = strtotime($srcDateTime);
        $adjustedTimestamp = strtotime($adjustment, $srcTimestamp);

        return (is_null($format)) ? (string) $adjustedTimestamp : date($format, $adjustedTimestamp);
    }
}
