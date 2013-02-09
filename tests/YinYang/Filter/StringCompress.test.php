<?php
/**
 * Unit test for the YinYang_Filter_StringCompress/StringDecompress class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_StringCompress
 * @package     YinYang_Filter_StringDecompress
 * @subpackage  UnitTest
 * @since       Sunday, 05 June 2011
 * @version     $Id: StringCompress.test.php 6 2011-06-05 16:17:11Z pricespin.craig $
 */
class YinYang_Filter_StringCompress_UnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * This tests ensures that the class can be instantiated.
     */
    public function setUp()
    {
        $object = new YinYang_Filter_StringCompress();
        $this->assertInstanceOf('YinYang_Filter_StringCompress', $object);


        $object = new YinYang_Filter_StringDecompress();
        $this->assertInstanceOf('YinYang_Filter_StringDecompress', $object);
    }

    /**
     * This test ensures that the strings are encrypted and then decrypted.
     *
     * @dataProvider provider
     */
    public function testCompressDecompress($value)
    {
        $compress = new YinYang_Filter_StringCompress();
        $decompress = new YinYang_Filter_StringDecompress();

        $compressed = $compress->filter($value);
        $decompressed = $decompress->filter($compressed);

        $this->assertEquals($value, $decompressed);
    }

    /**
     * This is a data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('abcdefghijklmnopqrstuvwxyzAAAAAAAAAAA'),
            array('abcdefghijklmnopqrstuvwxyz'),
            array('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),
            array('!"£$%^&*()_-+={}[]:;@\'~#<>,.?/|\\¬`'),
            array('0123456789'),
            array(
                'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!"£$%^&*()_-+={}[]:;@\'~#<>,.?/|\\¬`'
            ),
        );
    }
}