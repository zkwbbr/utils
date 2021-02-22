<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class FormattedDateTime
{

    /**
     * Format datetime string like
     * - YYYY-MM-DD H:i:s
     * - YYYY-MM-DD
     * - DD/MM/YYYY
     *
     * @param string $srcDateTime
     * @param string $format
     * @return string
     */
    public static function x(string $srcDateTime, string $format): string
    {
        $srcTimestamp = (int) \strtotime($srcDateTime);

        return \date($format, $srcTimestamp);
    }
}
