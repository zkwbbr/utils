<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class RandomNumber
{

    /**
     * Generate random number based on length
     *
     * @param int $length
     * @return int
     */
    public static function x(int $length = 6): int
    {

        $s = '';

        for ($i = 1; $i <= $length; $i++) {
            $s .= random_int(1, 9);
        }

        return (int) $s;
    }
}
