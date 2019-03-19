<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Postpulate
{

    /**
     * Populate array with data from $_POST
     *
     * @param array $fields
     * @return array
     */
    public static function x(array $fields): array
    {
        $newData = [];

        foreach ($fields as $k => $v) {

            $newData[$k] = '';

            if (isset($_POST[$k])) {
                $newData[$k] = $_POST[$k];
            }
        }

        return $newData;
    }
}
