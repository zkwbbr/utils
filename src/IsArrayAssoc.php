<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class IsArrayAssoc
{
    /**
     * Check if array is associative
     *
     * @param array $array
     * @return bool
     */
    public static function x(array $array): bool
    {
        return (\array_keys($array) != \array_keys(\array_keys($array)));
    }

}