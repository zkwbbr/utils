<?php

declare(strict_types=1);

namespace MyApp\Utils;

class Encrypt
{

    /**
     * Encrypt data with key
     *
     * @param  string $secret data to encrypt
     * @param  string $key encrption key that must be generated from vendor\bin\generate-defuse-key
     * @return string encrypted data
     */
    public static function x(string $data, string $key): string
    {
        $keyObject = \Defuse\Crypto\Key::loadFromAsciiSafeString($key);

        return \Defuse\Crypto\Crypto::encrypt($data, $keyObject);
    }
}
