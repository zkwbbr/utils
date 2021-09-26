<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class DateDiff
{
    /**
     *
     * @param string $dateMinuend
     * @param string $dateSubtrahend
     * @param string|null $format default is days with sign (-/+)
     * @return string
     */
    public static function x(string $dateMinuend, string $dateSubtrahend, ?string $format = null): string
    {
        if (!$format)
            $format = '%R%a';

        $dateMinuend = \date_create($dateMinuend);
        $dateSubtrahend = \date_create($dateSubtrahend);

        if (!$dateMinuend || !$dateSubtrahend) {

            $dateError = \print_r(\date_get_last_errors(), true);
            throw new \Exception('date_create error: ' . $dateError);
        }

        $diff = \date_diff($dateSubtrahend, $dateMinuend);

        return $diff->format($format);
    }

}