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
     * @param type $encoding
     * @param type $double_encode
     * @return string
     */
    public static function x(string $string, int $flags = ENT_COMPAT | ENT_HTML5, $encoding = 'UTF-8', $double_encode = true): string
    {
        return htmlspecialchars($string, $flags, $encoding, $double_encode);
    }
}
