<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class HtmlSpecialChars
{
    /**
     * Wrapper for \htmlspecialchars() with ideal default values
     *
     * @param string $string
     * @param int $flags
     * @param string $encoding
     * @param bool $doubleEncode
     * @return string
     */
    public static function x(
        string $string,
        int $flags = ENT_COMPAT | ENT_HTML5,
        string $encoding = 'UTF-8',
        bool $doubleEncode = true): string
    {
        return \htmlspecialchars($string, $flags, $encoding, $doubleEncode);
    }

}