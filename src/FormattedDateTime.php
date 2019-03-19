<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class FormattedDateTime
{

    /**
     * Format datetime string
     *
     * @param string $dateStamp
     * @param string $format
     * @return string
     */
    public static function x(string $srcDateTime, string $format): string
    {
        $srcTimestamp = strtotime($srcDateTime);

        return date($format, $srcTimestamp);
    }
}
