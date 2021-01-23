<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Redirect
{
    /**
     * Redirect to $link
     *
     * Note: Ideally you should wrap this method so you don't have to enter
     * $baseURL everytime and you might want to add an exit statement after.
     * We ommmitted the exit statement because code coverage doesn't run it.
     *
     * @param string $link
     * @param ?string $baseUrl If $link doesn't start with "http", $baseURl will be prefixed to $link (include trailing slash)
     * @param string $method "location" or "refresh"
     * @param integer $seconds Seconds before redirect, only works if $method == "refresh"
     */
    public static function x(string $link, ?string $baseUrl = null, string $method = 'location', int $seconds = 0): void
    {
        if (0 !== \strpos($link, 'http'))
            $link = $baseUrl . $link;

        $header = ($method == 'refresh') ?
            'refresh: ' . $seconds . '; url=' . $link :
            'location: ' . $link;

        \header('Cache-Control: no-store'); // prevent the source page from being cached (some browsers cache it)
        \header($header);

        // Note: we should ideally put an exit statement here but it is hard to mock.
        // It's recommended that you wrap this method and put your exit statement there.
    }

}