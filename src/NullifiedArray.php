<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class NullifiedArray
{

    /**
     * Nullify values of $array keys
     *
     * @param array $array
     * @return array
     */
    public static function x(array $array): array
    {
        foreach ($array as $k => $v)
            $na[$k] = null;

        return $na;
    }
}
