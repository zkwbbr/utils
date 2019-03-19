<?php

declare(strict_types=1);

namespace MyApp\Utils;

class RandomNumber
{

    /**
     * Generate random number
     *
     * @param int $length
     * @return string
     */
    public static function x(int $length = 6): string
    {

        $s = '';

        for ($i = 1; $i <= $length; $i++) {
            $s .= random_int(0, $length);
        }

        return $s;
    }
}
