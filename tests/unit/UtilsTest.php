<?php

use PHPUnit\Framework\TestCase;
use Zkwbbr\Utils;

class UtilsTest extends TestCase
{

    public function testFilesFromDirectory()
    {
        $dir = __DIR__ . '/testDir/';

        $files = Utils\FilesFromDirectory::x($dir);
        $this->assertCount(3, $files);

        $regex = '~testFile_1_~';
        $files = Utils\FilesFromDirectory::x($dir, $regex);
        $this->assertCount(2, $files);
        $this->assertEquals('testFile_1_1.txt', $files[0]);
        $this->assertEquals('testFile_1_2.txt', $files[1]);
    }

    public function testFormatDateTime()
    {
        $dateStamp = '2015-01-02 14:01:02';
        $actual = Utils\FormatDateTime::x($dateStamp, 'm d Y H:i:s');
        $expected = '01 02 2015 14:01:02';
        $this->assertEquals($expected, $actual);

        $dateStamp = '2015-01-02';
        $actual = Utils\FormatDateTime::x($dateStamp, 'm d Y');
        $expected = '01 02 2015';
        $this->assertEquals($expected, $actual);

        $dateStamp = '01/02/2015';
        $actual = Utils\FormatDateTime::x($dateStamp, 'm d Y');
        $expected = '01 02 2015';
        $this->assertEquals($expected, $actual);
    }

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
