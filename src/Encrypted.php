<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Encrypted
{

    /**
     * Wrapper for defuse/php-encryption's encrypt method
     *
     * Note: $key must be generated from vendor/bin/generate-defuse-key
     *
     * @param string $data
     * @param string $key
     * @return string
     */
    public static function x(string $data, string $key): string
    {
        $keyObject = \Defuse\Crypto\Key::loadFromAsciiSafeString($key);

        return \Defuse\Crypto\Crypto::encrypt($data, $keyObject);
    }
}
