<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class FilesFromDirectory
{

    /**
     *  Return an array of files inside $dir, filtered by $regex
     *
     * @param string $dir
     * @param string $regex
     * @return array
     */
    public static function x(string $dir, ?string $regex = null): array
    {
        $files = [];

        if (($handle = opendir($dir)) !== false) {

            while (($file = readdir($handle)) !== false) {
                if ($regex) {
                    if (preg_match($regex, $file)) {
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
