<?php

use PHPUnit\Framework\TestCase;
use Zkwbbr\Utils;

class UtilsTest extends TestCase
{

    public function testHasErrors()
    {
        $fields = [
            'firstName' => '',
            'lastName'  => ''
        ];

        $hasErrors = Utils\HasErrors::x($fields);

        $this->assertFalse($hasErrors);

        $fields = [
            'firstName' => 'dummy error message',
            'lastName'  => ''
        ];

        $hasErrors = Utils\HasErrors::x($fields);

        $this->assertTrue($hasErrors);
    }

    public function testInputTag()
    {
        $types = [
            'text',
            'email',
            'number'
        ];

        foreach ($types as $type) {
            $tag = Utils\InputTag::x('foo', $type, 'bar');
            $this->assertEquals('<input type="' . $type . '" name="foo" id="foo" value="bar" />', $tag);
        }
    }

    public function testPathSegment()
    {
        $path = 'https://example.com/foo/bar';

        $segment = Utils\PathSegment::x(0, $path);
        $this->assertEquals('foo', $segment);

        $segment = Utils\PathSegment::x(1, $path);
        $this->assertEquals('bar', $segment);
    }

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

        $newData = Utils\Postpulated::x($fields, $post);

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
