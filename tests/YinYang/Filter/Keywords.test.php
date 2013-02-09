<?php

/**
 * Unit test for the YinYang_Filter_Keywords class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_Keywords
 * @subpackage  UnitTest
 * @since       Sunday, 05 June 2011
 * @version     $Id: Keywords.test.php 14 2011-06-28 10:04:45Z mail@henryhayes.co.uk $
 */
class YinYang_Filter_KeywordsTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test ensures that the value is correctly filtered.
     *
     * @dataProvider provider
     */
    public function testKeywords($value, $expected)
    {
        $filter = new YinYang_Filter_Keywords();
        $this->assertInstanceOf('YinYang_Filter_Keywords', $filter);

        $this->assertEquals($expected, $filter->filter($value));
    }

    /**
     * This is a data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('keyword1, keyword2, keyword3, keyword4, ', 'keyword1,keyword2,keyword3,keyword4'),
            array('keyword1,  keyword2,  keyword3,  keyword4,  ', 'keyword1,keyword2,keyword3,keyword4'),
            array('keyword1, keyword2,  keyword3, keyword4,  ', 'keyword1,keyword2,keyword3,keyword4'),
        );
    }
}