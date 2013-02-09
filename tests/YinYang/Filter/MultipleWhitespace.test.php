<?php

/**
 * Unit test for the YinYang_Filter_MultipleWhitespace class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_MultipleWhitespace
 * @subpackage  UnitTest
 * @since       Thursday, 13 October 2011
 * @version     $Id: MultipleWhitespace.test.php 17 2011-10-13 10:05:31Z mail@henryhayes.co.uk $
 */
class YinYang_Filter_MultipleWhitespaceTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test ensures that the value is correctly filtered.
     *
     * @dataProvider provider
     */
    public function testMultipleWhitespace($value, $expected)
    {
        $filter = new YinYang_Filter_MultipleWhitespace();
        $this->assertInstanceOf('YinYang_Filter_MultipleWhitespace', $filter);

        $this->assertEquals($expected, $filter->filter($value));
    }

    /**
     * This is a data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('   ', ' '),
            array('keyword1  keyword2  keyword3  keyword4  ', 'keyword1 keyword2 keyword3 keyword4 '),
            array('keyword1  keyword2 keyword3 keyword4  ', 'keyword1 keyword2 keyword3 keyword4 '),
        );
    }
}