<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class IsArrayMultiAssoc
{
    /**
     * Check if array is multi-associative
     *
     * @param mixed[] $array
     * @return bool
     */
    public static function x(array $array): bool
    {
        foreach ($array as $v)
            if (\is_array($v))
                return true;

        return false;
    }

}