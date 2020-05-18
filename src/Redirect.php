<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Redirect
{
    /**
     * Redirect to $link
     *
     * Note: Ideally you should wrap this method so you don't have to enter
     * $baseURL everytime
     *
     * @param string $link
     * @param ?string $baseUrl If $link doesn't start with "http", $baseURl will be prefixed to $link (include trailing slash)
     * @param string $method "location" or "refresh"
     * @param integer $seconds Seconds before redirect, only works if $method == "refresh"
     * @param bool $withExit Set to false if you want to remove the exit directive (usually used for testing)
     */
    public static function x(string $link, ?string $baseUrl = null, string $method = 'location', int $seconds = 0, bool $withExit = true): void
    {
        if (0 !== \strpos($link, 'http'))
            $link = $baseUrl . $link;

        $header = ($method == 'refresh') ?
            'refresh: ' . $seconds . '; url=' . $link :
            'location: ' . $link;

        \header($header);

        if ($withExit)
            exit; // note: 'exit' is hard to mock
    }

}