<?php

use PHPUnit\Framework\TestCase;
use Zkwbbr\Utils;

class UtilsTest extends TestCase
{

    public function testRandomNummber()
    {
        $desiredLength = 9;

        $num = Utils\RandomNumber::x($desiredLength);

        $actualLength = strlen($num);

        $this->assertIsInt($num);

        $this->assertEquals($desiredLength, $actualLength);
    }
}
