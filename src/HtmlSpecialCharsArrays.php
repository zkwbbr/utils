<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class HtmlSpecialCharsArrays
{

    /**
     * Apply \htmlspecialchars() (with ideal default values) in all strings of a two-dimensional array
     *
     * Typical useful in databse results
     *
     * @param array $arrays
     * @param int $flags
     * @param type $encoding
     * @param type $double_encode
     * @return array
     */
    public static function x(array $arrays, int $flags = ENT_COMPAT | ENT_HTML5, $encoding = 'UTF-8', $double_encode = true): array
    {
        foreach ($arrays as $k => $arr)
            foreach ($arr as $k2 => $str)
                if (is_string($str))
                    $arrays[$k][$k2] = htmlspecialchars($str, $flags, $encoding, $double_encode);

        return $arrays;
    }
}
