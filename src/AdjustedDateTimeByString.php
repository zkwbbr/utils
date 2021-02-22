<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class AdjustedDateTimeByString
{

    /**
     * Adjust and format datetime string like
     * - YYYY-MM-DD H:i:s
     * - YYYY-MM-DD
     * - DD/MM/YYYY
     *
     * @param string $srcDateTime
     * @param string $adjustment (e.g., +1 year)
     * @param string $format standard date formats, if null, returns unix timestamp format
     * @return string
     */
    public static function x(string $srcDateTime, string $adjustment, ?string $format = null): string
    {
        $srcTimestamp = (int) \strtotime($srcDateTime);
        $adjustedTimestamp = (int) \strtotime($adjustment, $srcTimestamp);

        return (\is_null($format)) ? (string) $adjustedTimestamp : \date($format, $adjustedTimestamp);
    }
}
