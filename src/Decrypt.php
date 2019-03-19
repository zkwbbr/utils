<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class Decrypt
{

    /**
     * Decrypt data with key
     *
     * @param  string $secret data to decrypt
     * @param  string $key encrption key
     * @return string decrypted data
     */
    public static function x(string $data, string $key): string
    {
        $keyObject = \Defuse\Crypto\Key::loadFromAsciiSafeString($key);

        return \Defuse\Crypto\Crypto::decrypt($data, $keyObject);
    }
}
