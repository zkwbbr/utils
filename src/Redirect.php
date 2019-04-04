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
     */
    public static function x(string $link, ?string $baseUrl = null, string $method = 'location', int $seconds = 0): void
    {
        $header = Redirect::getHeaderString($link, $baseUrl, $method, $seconds);

        header($header);
        exit;
    }

    /**
     * This method is created so Redirect::x can be tested
     *
     * @param string $link
     * @param string|null $baseUrl
     * @param string $method
     * @param int $seconds
     * @return string
     */
    public static function getHeaderString(string $link, ?string $baseUrl = null, string $method = 'location', int $seconds = 0): string
    {
        if (0 !== strpos($link, 'http'))
            $link = $baseUrl . $link;

        return ($method == 'refresh') ?
            'refresh: ' . $seconds . '; url=' . $link :
            'location: ' . $link;
    }
}
