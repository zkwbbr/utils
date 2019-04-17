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
        $parsedUrl = parse_url($url, PHP_URL_PATH);

        if (!$parsedUrl)
            return null;

        $paths = trim($parsedUrl, '/');

        if (empty($paths))
            return null;

        $paths = explode('/', $paths);

        return $paths[$key] ?? null;
    }
}
