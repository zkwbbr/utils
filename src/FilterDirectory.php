<?php

declare(strict_types=1);

namespace MyApp\Utils;

class FilterDirectory
{
    /**
     *  Return an array of files inside $dir, filtered by $needle using regex
     *
     * @param string $dir
     * @param string $needle
     * @return array
     */
    public static function x(string $dir, string $needle = null): array
    {
        $files = [];

        if (($handle = opendir($dir)) !== false) {

            while (($file = readdir($handle)) !== false) {
                if ($needle) {
                    if (preg_match($needle, $file)) {
                        $files[] = $file;
                    }

                } else {
                    if ($file != '.' && $file != '..' && $file != 'Thumbs.db') {
                        $files[] = $file;
                    }

                }
            }

            closedir($handle);
        }

        return $files;
    }

}
