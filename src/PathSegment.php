<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class PathSegment
{

    /**
     * Get path segment of a URL based on key
     *
     * @param int $key
     * @param string $url
     * @return string|null
     */
    public static function x(int $key, string $url): ?string
    {
        $paths = trim(parse_url($url, PHP_URL_PATH), '/');

        $paths = explode('/', $paths);

        return $paths[$key] ?? null;
    }
}
