<?php

use PHPUnit\Framework\TestCase;
use Zkwbbr\Utils;

class UtilsTest extends TestCase
{

    public function testAdjustedDateTimeByTimeZone()
    {
        date_default_timezone_set('UTC');

        $format = 'Y-m-d H:i:s';
        $srcDateTime = date($format);
        $newTimezone = 'America/Los_Angeles';

        $actual = Utils\AdjustedDateTimeByTimeZone::x($srcDateTime, $newTimezone, $format);

        $srcTimestamp = strtotime($srcDateTime);
        $adjustedTimestamp = strtotime('-7 hours', $srcTimestamp);
        $expected = date($format, $adjustedTimestamp);

        $this->assertEquals($expected, $actual);
    }

    public function testAdjustedDateTimeByString()
    {
        $srcDatetime = '2015-01-02 14:01:02';
        $adjustment = '+1 day';
        $format = 'm d Y';
        $adjusted = Utils\AdjustedDateTimeByString::x($srcDatetime, $adjustment, $format);
        $expected = '01 03 2015';
        $this->assertEquals($expected, $adjusted);
    }

    public function testEncryptAndDecrypt()
    {
        $key = 'def00000d640951d2b248dc1d266c50a159b9419db4a0b33eb798937b9a2ad3b3890607a4161c814d6d70294e83efc565a535e12b2b97039a41d4e99ed88aa094ad47133';
        $data = 'foo';
        $encrypted = Utils\Encrypted::x($data, $key);
        $decrypted = Utils\Decrypted::x($encrypted, $key);
        $this->assertEquals($data, $decrypted);
    }

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

    public function testFormattedDateTime()
    {
        $dateStamp = '2015-01-02 14:01:02';
        $actual = Utils\FormattedDateTime::x($dateStamp, 'm d Y H:i:s');
        $expected = '01 02 2015 14:01:02';
        $this->assertEquals($expected, $actual);

        $dateStamp = '2015-01-02';
        $actual = Utils\FormattedDateTime::x($dateStamp, 'm d Y');
        $expected = '01 02 2015';
        $this->assertEquals($expected, $actual);

        $dateStamp = '01/02/2015';
        $actual = Utils\FormattedDateTime::x($dateStamp, 'm d Y');
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

    public function testRedirectHeaderString()
    {
        $link = 'foo/bar/1';
        $baseUrl = 'http://example.com/';
        $method = 'refresh';
        $seconds = 5;

        $actual = Utils\Redirect::getHeaderString($link, $baseUrl);
        $expected = 'location: ' . $baseUrl . $link;
        $this->assertEquals($expected, $actual);

        $actual = Utils\Redirect::getHeaderString($link, $baseUrl, $method);
        $expected = 'refresh: 0; url=' . $baseUrl . $link;
        $this->assertEquals($expected, $actual);

        $link = 'http://google.com';
        $actual = Utils\Redirect::getHeaderString($link, $baseUrl, $method, $seconds);
        $expected = 'refresh: ' . $seconds . '; url=' . $link;
        $this->assertEquals($expected, $actual);
    }

    public function testNullifiedArray()
    {
        $array = [
            'foo' => 'hello',
            'bar' => 'word'
        ];

        $na = Utils\NullifiedArray::x($array);

        $this->assertEquals($na['foo'], null);
        $this->assertEquals($na['bar'], null);
    }

    public function testAnchorTag()
    {
        $link = 'controller/method';
        $text = 'click here';
        $baseUrl = null;
        $extra = null;
        $actual = Utils\AnchorTag::x($link, $text, $baseUrl, $extra);
        $expected = '<a href="' . $link . '">' . $text . '</a>';
        $this->assertEquals($expected, $actual);

        $baseUrl = 'http://example.com/';
        $actual = Utils\AnchorTag::x($link, $text, $baseUrl, $extra);
        $expected = '<a href="' . $baseUrl . $link . '">' . $text . '</a>';
        $this->assertEquals($expected, $actual);

        $link = 'http://google.com';
        $actual = Utils\AnchorTag::x($link, $text, $baseUrl, $extra);
        $expected = '<a href="' . $link . '">' . $text . '</a>';
        $this->assertEquals($expected, $actual);

        $text = null;
        $actual = Utils\AnchorTag::x($link, $text, $baseUrl, $extra);
        $expected = '<a href="' . $link . '">' . $link . '</a>';
        $this->assertEquals($expected, $actual);

        $extra = 'target="_blank"';
        $actual = Utils\AnchorTag::x($link, $text, $baseUrl, $extra);
        $expected = '<a href="' . $link . '" ' . $extra . '>' . $link . '</a>';
        $this->assertEquals($expected, $actual);
    }

    public function testImageTag()
    {
        $src = 'foo.jpg';
        $baseUrl = null;
        $alt = null;
        $extra = null;
        $actual = Utils\ImageTag::x($src, $baseUrl, $alt, $extra);
        $expected = '<img src="' . $src . '" alt="' . $alt . '" />';
        $this->assertEquals($expected, $actual);

        $baseUrl = 'http://example.com/images/';
        $actual = Utils\ImageTag::x($src, $baseUrl, $alt, $extra);
        $expected = '<img src="' . $baseUrl . $src . '" alt="' . $alt . '" />';
        $this->assertEquals($expected, $actual);

        $alt = 'bar';
        $actual = Utils\ImageTag::x($src, $baseUrl, $alt, $extra);
        $expected = '<img src="' . $baseUrl . $src . '" alt="' . $alt . '" />';
        $this->assertEquals($expected, $actual);

        $extra = 'height="50"';
        $actual = Utils\ImageTag::x($src, $baseUrl, $alt, $extra);
        $expected = '<img src="' . $baseUrl . $src . '" alt="' . $alt . '" ' . $extra . ' />';
        $this->assertEquals($expected, $actual);
    }
}
