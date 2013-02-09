<?php
/**
 * Unit test for the YinYang_Filter_DateTime class.
 *
 * @category    YinYang
 * @package     YinYang_View_Helper_DateTime
 * @subpackage  UnitTest
 * @since       Friday, 7th August 2012
 * @version     $Id$
 */
class YinYang_View_Helper_DateTimeTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests the dateTime method works as expected.
     */
    public function testDateTimeWithParamsReturnsAsExpected()
    {
        $sut = $this->getMock('YinYang_View_Helper_DateTime', array('format'));
        $sut->expects($this->exactly(1))
            ->method('format')
            ->with($this->equalTo('one'), $this->equalTo('two'))
            ->will($this->returnValue('three'));

        $this->assertEquals('three', $sut->dateTime('one', 'two'));

        $sut = new YinYang_View_Helper_DateTime();
        $this->assertInstanceOf('YinYang_View_Helper_DateTime', $sut->dateTime());
    }

    /**
     * Tests the format method works as expected.
     *
     * @dataProvider formatDataProvider
     */
    public function testFormat($dateTime, $format, $result)
    {
        $sut = new YinYang_View_Helper_DateTime();

        $this->assertEquals($result, $sut->format($dateTime, $format));

    }

    /**
     * Data provider for the format unit test.
     */
    public function formatDataProvider()
    {
        $data = array();

        // String test with a custom format.
        $dateTimeString = date('Y-m-d H:i:s', strtotime('2012/08/07 10:01am'));
        $dateTimeResult = date(DATE_W3C, strtotime('2012/08/07 10:01am'));
        $data[0][0] = $dateTimeString;
        $data[0][1] = DATE_W3C;
        $data[0][2] = $dateTimeResult;

        // String test with default date format
        $dateTimeString = date('Y-m-d H:i:s', strtotime('2012/08/07 10:02am'));
        $dateTimeResult = date(DATE_ISO8601, strtotime('2012/08/07 10:02am'));
        $data[1][0] = $dateTimeString;
        $data[1][1] = null;
        $data[1][2] = $dateTimeResult;

        // Object test
        $dateTimeObject = new DateTime(date(DATE_W3C, strtotime('2012/08/07 10:04am')));
        $dateTimeResult = date(DATE_W3C, strtotime('2012/08/07 10:04am'));
        $data[2][0] = $dateTimeObject;
        $data[2][1] = DATE_W3C;
        $data[2][2] = $dateTimeResult;

        return $data;
    }
}