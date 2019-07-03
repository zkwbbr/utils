<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class RandomReadable
{

    /**
     * Returns random alpha numeric characters in uppercase without similar looking characters (0,O,Q,I,1)
     *
     * @param int $length
     * @return string
     */
    public static function x(int $length): string
    {
        $pool = \explode(',', 'A,B,C,D,E,F,G,H,J,K,L,M,N,P,R,S,T,U,V,W,X,Y,Z,2,3,4,5,6,7,8,9');

        $s = '';

        for ($i = 0; $i < $length; $i++)
            $s .= $pool[\random_int(0, \count($pool) - 1)];

        // we need to typecast here because there's a probability only integers will be retured
        return (string) $s;
    }
}
