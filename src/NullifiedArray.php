<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class NullifiedArray
{
    /**
     * Nullify values of $array keys
     *
     * @param mixed[] $array
     * @return mixed[]
     */
    public static function x(array $array): array
    {
        $na = [];

        foreach ($array as $k => $v)
            $na[$k] = null;

        return $na;
    }

}