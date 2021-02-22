<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

use Zkwbbr\Utils\IsArrayAssoc;

class ForcedAssocArray
{
    /**
     * If given $array is not associative, make its value as keys, else return
     * it unmodified
     *
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function x(array $array): array
    {
        if (IsArrayAssoc::x($array))
            return $array;

        $newArray = [];
        foreach ($array as $k => $v)
            $newArray[$v] = $v;

        return $newArray;
    }

}