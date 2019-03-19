<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class HasErrors
{

    /**
     * Check if an array of fields has error messages
     *
     * @param array $fields
     * @return bool
     */
    public static function x(array $fields): bool
    {
        $hasErrors = false;

        foreach ($fields as $v) {
            if ($v !== null) {
                $hasErrors = true;
            }
        }

        return $hasErrors;
    }
}
