<?php

declare(strict_types=1);

namespace MyApp\Utils;

class PathSegment
{

    /**
     * Get path segment based on key
     *
     * @param int $key
     * @param string $path
     * @return string|null
     */
    public static function x(int $key, string $path): ?string
    {
        $paths = trim(parse_url($path, PHP_URL_PATH), '/');

        $paths = explode('/', $paths);

        return $paths[$key] ?? null;
    }
}
