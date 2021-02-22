<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class HtmlSpecialCharsArrays
{
    /**
     * Apply \htmlspecialchars() (with ideal default values) in all strings of a one or two-dimensional array
     *
     * Typical useful in database results
     *
     * @param mixed[] $array
     * @param int $flags
     * @param string $encoding
     * @param bool $doubleEncode
     * @return mixed[]
     */
    public static function x(
        array $array,
        int $flags = ENT_COMPAT | ENT_HTML5,
        string $encoding = 'UTF-8',
        bool $doubleEncode = true): array
    {
        // get first key of $array
        reset($array);
        $firstKey = key($array);

        // process one-dimensional array
        if (is_string($array[$firstKey])) {
            foreach ($array as $k => $v)
                if (is_string($v))
                    $array[$k] = htmlspecialchars($v, $flags, $encoding, $doubleEncode);
            return $array;
        }

        // process two-dimensional array
        foreach ($array as $k => $arr)
            foreach ($arr as $k2 => $v)
                if (is_string($v))
                    $array[$k][$k2] = htmlspecialchars($v, $flags, $encoding, $doubleEncode);

        return $array;
    }

}