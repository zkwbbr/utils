<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class RandomReadableAlt
{
    /**
     * Returns random alpha numeric characters in uppercase without similar looking characters (0,O,I,1)
     * and alternates between letters and numbers
     *
     * @param int $length
     * @return string
     */
    public static function x(int $length): string
    {
        $letters = \explode(',', 'A,B,C,D,E,F,G,H,J,K,L,M,N,P,Q,R,S,T,U,V,W,X,Y,Z');
        $numbers = \explode(',', '2,3,4,5,6,7,8,9');

        $s = '';

        for ($i = 0; $i < $length; $i++)
            $s .= ($i % 2) ? $numbers[self::randomKey($numbers)] : $letters[self::randomKey($letters)];

        return $s;
    }

    /**
     * Get a random key out of array $pool
     *
     * @param mixed[] $pool
     * @return int
     */
    private static function randomKey(array $pool): int
    {
        return \random_int(0, \count($pool) - 1);
    }

}