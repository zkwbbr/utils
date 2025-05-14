<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class AnchorTag
{
    /**
     * Generate an HTML anchor tag
     *
     * Note: Ideally you should wrap this method so you don't have to enter
     * $baseURL everytime
     *
     * @param string $link
     * @param string|null $text
     * @param string|null $baseUrl If $link doesn't start with any of the $schemes, $baseURl will be prefixed to $link (include trailing slash)
     * @param string|null $extra
     * @return string
     */
    public static function x(string $link, ?string $text = null, ?string $baseUrl = null, ?string $extra = null): string
    {
        $text = $text ?? $link;

        if ($extra)
            $extra = ' ' . $extra;

        $schemes = [
            'http:',
            'https:',
            'mailto:',
            'tel:',
            'sms:',
            'ftp:',
            'file:',
            'data:',
            'javascript:',
            'magnet:',
            'geo:',
            'about:',
            'intent:'
        ];

        $hasScheme = false;
        foreach ($schemes as $s)
            if (\stripos($link, $s) === 0) {
                $hasScheme = true;
                break;
        }

        if (!$hasScheme)
            $link = $baseUrl . $link;

        return '<a href="' . $link . '"' . $extra . '>' . $text . '</a>';
    }
}