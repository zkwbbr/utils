<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Zkwbbr\Utils;

class UtilsTest extends TestCase
{
    public function test_AdjustedDateTimeByTimeZone_validData_pass()
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

    public function test_AdjustedDateTimeByString_validData_pass()
    {
        $srcDatetime = '2015-01-02 14:01:02';
        $adjustment = '+1 day';
        $format = 'm d Y';
        $adjusted = Utils\AdjustedDateTimeByString::x($srcDatetime, $adjustment, $format);
        $expected = '01 03 2015';
        $this->assertEquals($expected, $adjusted);
    }

    public function test_EncryptAndDecrypt_validData_pass()
    {
        $key = 'def00000d640951d2b248dc1d266c50a159b9419db4a0b33eb798937b9a2ad3b3890607a4161c814d6d70294e83efc565a535e12b2b97039a41d4e99ed88aa094ad47133';
        $data = 'foo';
        $encrypted = Utils\Encrypted::x($data, $key);
        $decrypted = Utils\Decrypted::x($encrypted, $key);
        $this->assertEquals($data, $decrypted);
    }

    public function test_FilesFromDirectory_validData_pass()
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

    public function test_FormattedDateTime_validData_pass()
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

    public function test_HasErrors_validData_pass()
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

    public function test_InputTag_validData_pass()
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

    public function test_PathSegment_validData_pass()
    {
        $path = 'https://example.com'; // without trailing slash
        $segment = Utils\PathSegment::x(0, $path);
        $this->assertNull($segment);

        $path = 'https://example.com/'; // with trailing slash
        $segment = Utils\PathSegment::x(0, $path);
        $this->assertNull($segment);

        $path = 'https://example.com/foo/bar';

        $segment = Utils\PathSegment::x(0, $path);
        $this->assertEquals('foo', $segment);

        $segment = Utils\PathSegment::x(1, $path);
        $this->assertEquals('bar', $segment);
    }

    public function test_PostPulated_validData_pass()
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

    public function test_RandomNummber_validData_pass()
    {
        $desiredLength = 9;

        $num = Utils\RandomNumber::x($desiredLength);

        $actualLength = strlen((string) $num);

        $this->assertIsInt($num);
        $this->assertEquals($desiredLength, $actualLength);
    }

    /**
     * The annotation @runInSeparateProcess below is important
     * See: https://stackoverflow.com/questions/9745080 for more info
     *
     * @runInSeparateProcess
     */
    public function test_Redirect_usingLocation_pass()
    {
        $link = 'foo/bar/1';
        $baseUrl = 'http://example.com/';
        $method = 'location';
        $seconds = 5;

        // ------------------------------------------------

        Utils\Redirect::x($link, $baseUrl, $method, $seconds);
        $expected = 'location: ' . $baseUrl . $link;
        $actual = \xdebug_get_headers()[0];
        $this->assertEquals($expected, $actual);
    }

    /**
     * The annotation @runInSeparateProcess below is important
     * See: https://stackoverflow.com/questions/9745080 for more info
     *
     * @runInSeparateProcess
     */
    public function test_Redirect_usingRefresh_pass()
    {
        $link = 'foo/bar/1';
        $baseUrl = 'http://example.com/';
        $method = 'refresh';
        $seconds = 5;

        // ------------------------------------------------

        Utils\Redirect::x($link, $baseUrl, $method, $seconds);
        $expected = 'refresh: 5; url=' . $baseUrl . $link;
        $actual = \xdebug_get_headers()[0];
        $this->assertEquals($expected, $actual);
    }

    /**
     * The annotation @runInSeparateProcess below is important
     * See: https://stackoverflow.com/questions/9745080 for more info
     *
     * @runInSeparateProcess
     */
    public function test_Redirect_toExternalUrl_pass()
    {
        $link = 'https://google.com';
        $baseUrl = null;
        $method = 'refresh';
        $seconds = 5;

        // ------------------------------------------------

        Utils\Redirect::x($link, $baseUrl, $method, $seconds);
        $expected = 'refresh: 5; url=' . $baseUrl . $link;
        $actual = \xdebug_get_headers()[0];
        $this->assertEquals($expected, $actual);
    }

    public function test_NullifiedArray_validData_pass()
    {
        $array = [
            'foo' => 'hello',
            'bar' => 'word'
        ];

        $na = Utils\NullifiedArray::x($array);

        $this->assertEquals($na['foo'], null);
        $this->assertEquals($na['bar'], null);
    }

    public function test_AnchorTag_validData_pass()
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

    public function test_ImageTag_validData_pass()
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

    public function test_HtmlSpecialChars_validData_pass()
    {
        $s = '<b>foo</b>';
        $actual = Utils\HtmlSpecialChars::x($s);
        $expected = '&lt;b&gt;foo&lt;/b&gt;';
        $this->assertEquals($expected, $actual);
    }

    public function test_HtmlSpecialCharsArraysOneDimension_validData_pass()
    {
        $array = [
            'foo' => '<b>hello</b>',
            'bar' => '&',
            'qux' => '<b>world</b>'
        ];

        $array = Utils\HtmlSpecialCharsArrays::x($array);

        $actual = $array['foo'];
        $expected = '&lt;b&gt;hello&lt;/b&gt;';
        $this->assertEquals($expected, $actual);

        $actual = $array['bar'];
        $expected = '&amp;';
        $this->assertEquals($expected, $actual);

        $actual = $array['qux'];
        $expected = '&lt;b&gt;world&lt;/b&gt;';
        $this->assertEquals($expected, $actual);
    }

    public function test_HtmlSpecialCharsArraysTwoDimensions_validData_pass()
    {
        $arrays = [
            0 => ['foo' => '<b>hello</b>'],
            1 => ['bar' => '&'],
            2 => ['qux' => '<b>world</b>']
        ];

        $arrays = Utils\HtmlSpecialCharsArrays::x($arrays);

        $actual = $arrays[0]['foo'];
        $expected = '&lt;b&gt;hello&lt;/b&gt;';
        $this->assertEquals($expected, $actual);

        $actual = $arrays[1]['bar'];
        $expected = '&amp;';
        $this->assertEquals($expected, $actual);

        $actual = $arrays[2]['qux'];
        $expected = '&lt;b&gt;world&lt;/b&gt;';
        $this->assertEquals($expected, $actual);
    }

    public function testRandomReadable_validData_pass()
    {
        $random = Utils\RandomReadable::x(5);
        $length = \mb_strlen($random);
        $this->assertEquals(5, $length);

        $random1 = Utils\RandomReadable::x(5);
        $random2 = Utils\RandomReadable::x(5);
        $this->assertNotEquals($random1, $random2);
    }

    public function test_RandomReadableAlt_validData_pass()
    {
        $random = Utils\RandomReadableAlt::x(5);
        $length = \mb_strlen($random);
        $this->assertEquals(5, $length);

        $random1 = Utils\RandomReadableAlt::x(5);
        $random2 = Utils\RandomReadableAlt::x(5);
        $this->assertNotEquals($random1, $random2);

        // test if it always returns letters first then numbers second
        for ($i = 0; $i < 100; $i++) {
            $random = Utils\RandomReadableAlt::x(5);
            $this->assertIsString($random[0]);
            $this->assertIsNumeric($random[1]);
        }
    }

    public function test_SelectTag_basicArray_pass()
    {
        $array = [
            'foo',
            'bar',
        ];

        $selectTag = Utils\SelectTag::x($array, 'sample');

        // ------------------------------------------------

        $expected = '<select id="sample" name="sample"><option value="">- Select -</option><option value="foo">foo</option><option value="bar">bar</option></select>';
        $actual = $selectTag;
        $this->assertEquals($expected, $actual);
    }

    public function test_SelectTag_multiAssocArray2levels_pass()
    {
        $array = [
            'foo' => ['a', 'b'],
            'bar' => ['c', 'd']
        ];

        $selectTag = Utils\SelectTag::x($array, 'sample');

        // ------------------------------------------------

        $expected = '<select id="sample" name="sample"><option value="">- Select -</option><optgroup label="foo"><option value="a">a</option><option value="b">b</option></optgroup><optgroup label="bar"><option value="c">c</option><option value="d">d</option></optgroup></select>';
        $actual = $selectTag;
        $this->assertEquals($expected, $actual);
    }

    public function test_SelectTag_multiAssocArray3levels_pass()
    {
        $array = [
            'Protoss' => [
                'Gateway'  => ['Zealot', 'Stalker'],
                'Stargate' => ['Phoenix', 'Carrier']
            ],
            'Terran'  => [
                'Barracks' => ['Marine', 'Marauder'],
                'Factory'  => ['Seige Tank', 'Thor']
            ]
        ];

        $selectTag = Utils\SelectTag::x($array, 'streets');

        // ------------------------------------------------

        $expected = '<select id="streets" name="streets"><option value="">- Select -</option><optgroup label="Protoss"><optgroup label="&nbsp;&nbsp;&nbsp;Gateway"><option value="Zealot">&nbsp;&nbsp;&nbsp;Zealot</option><option value="Stalker">&nbsp;&nbsp;&nbsp;Stalker</option></optgroup><optgroup label="&nbsp;&nbsp;&nbsp;Stargate"><option value="Phoenix">&nbsp;&nbsp;&nbsp;Phoenix</option><option value="Carrier">&nbsp;&nbsp;&nbsp;Carrier</option></optgroup></optgroup><optgroup label="Terran"><optgroup label="&nbsp;&nbsp;&nbsp;Barracks"><option value="Marine">&nbsp;&nbsp;&nbsp;Marine</option><option value="Marauder">&nbsp;&nbsp;&nbsp;Marauder</option></optgroup><optgroup label="&nbsp;&nbsp;&nbsp;Factory"><option value="Seige Tank">&nbsp;&nbsp;&nbsp;Seige Tank</option><option value="Thor">&nbsp;&nbsp;&nbsp;Thor</option></optgroup></optgroup></select>';
        $actual = $selectTag;
        $this->assertEquals($expected, $actual);
    }

}