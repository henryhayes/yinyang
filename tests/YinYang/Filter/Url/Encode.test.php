<?php
/**
 * Unit test for the YinYang_Filter_Url_Encode class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_Url_Encode
 * @subpackage  Test
 * @since       Sunday, 22 April 2012
 * @version     $Id: Encode.test.php 46 2012-04-22 16:01:04Z mail@henryhayes.co.uk $
 */
class YinYang_Filter_Url_EncodeTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test instatiates a YinYang_Filter_Url_Encode instance
     * and runs the tests from the data provider below.
     *
     * @dataProvider provider
     */
    public function testFilter($value, $result)
    {
        $obj = new YinYang_Filter_Url_Encode();

        $this->assertEquals($result, $obj->filter($value));
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('¬`!"£$%^&*()+=', '%C2%AC%60%21%22%C2%A3%24%25%5E%26%2A%28%29%2B%3D'),
            array('{}[]:;<>,@~#', '%7B%7D%5B%5D%3A%3B%3C%3E%2C%40%7E%23'),
            array('-_. ', '-_.+'),
        );
    }
}