<?php

use PHPUnit\Framework\TestCase;
use Zkwbbr\Utils;

class UtilsTest extends TestCase
{

    public function testPostPulated()
    {
        $fields = [
            'firstName',
            'lastName'
        ];

        $post = [
            'firstName' => 'foo',
            'lastName'  => 'bar',
            'extra'     => 'qux'
        ];

        $newData = Utils\Postpulate::x($fields, $post);

        $this->assertCount(2, $newData);
        $this->assertEquals('foo', $newData['firstName']);
        $this->assertEquals('bar', $newData['lastName']);
    }

    public function testRandomNummber()
    {
        $desiredLength = 9;

        $num = Utils\RandomNumber::x($desiredLength);

        $actualLength = strlen($num);

        $this->assertIsInt($num);
        $this->assertEquals($desiredLength, $actualLength);
    }
}
