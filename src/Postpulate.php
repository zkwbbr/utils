<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Postpulate
{

    /**
     * Populate keys of array $fields with value from array $data
     *
     * @param array $fields
     * @param array $data This is usually $_POST
     * @return array
     */
    public static function x(array $fields, array $data): array
    {
        foreach ($fields as $k => $v)
            if (isset($data[$v]))
                $newData[$v] = $data[$v];

        return $newData;
    }
}
