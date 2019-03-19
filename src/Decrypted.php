<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Decrypted
{

    /**
     * Wrapper for defuse/php-encryption's decrypt method
     *
     *  Note: $key must be generated from vendor/bin/generate-defuse-key
     *
     * @param string $data
     * @param string $key
     * @return string
     */
    public static function x(string $data, string $key): string
    {
        $keyObject = \Defuse\Crypto\Key::loadFromAsciiSafeString($key);

        return \Defuse\Crypto\Crypto::decrypt($data, $keyObject);
    }
}
