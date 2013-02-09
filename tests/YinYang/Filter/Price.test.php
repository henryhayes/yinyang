<?php

/**
 * Unit test for the YinYang_Filter_Price class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_Price
 * @subpackage  UnitTest
 * @since       Saturday, 28 January 2012
 * @version     $Id: Price.test.php 34 2012-01-28 18:24:22Z mail@henryhayes.co.uk $
 */
class YinYang_Filter_PriceTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test ensures that the value is correctly filtered.
     *
     * @dataProvider provider
     */
    public function testPrice($value, $expected)
    {
        $filter = new YinYang_Filter_Price();
        $this->assertInstanceOf('YinYang_Filter_Price', $filter);

        $this->assertSame($expected, $filter->filter($value));
    }

    /**
     * This is a data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('£3.99', '3.99'),
            array('$2.99 USD', '2.99'),
            array('€4,999,999.01', '4999999.01'),
            array('€4999999,01', '4999999.01'),
        );
    }
}