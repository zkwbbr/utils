<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class ImageTag
{

    /**
     * Generate an HTML image tag
     *
     * Note: Ideally you should wrap this method so you don't have to enter
     * $baseURL everytime
     *
     * @param string $src
     * @param string|null $baseUrl If $src doesn't have "//", $baseURl will be prefixed to $src (include trailing slash)
     * @param string|null $alt
     * @param string|null $extra
     * @return string
     */
    public static function x(string $src, ?string $baseUrl = null, ?string $alt = null, ?string $extra = null): string
    {
        if ($extra)
            $extra = ' ' . $extra;

        $src = (strpos($src, '//') === false) ? $baseUrl . $src : $src;

        return '<img src="' . $src . '" alt="' . $alt . '"' . $extra . ' />';
    }
}
