<?php
/**
 * Unit test for the YinYang_Filter_Barcode_Ean13 class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_Barcode_Ean13
 * @subpackage  UnitTest
 * @since       Saturday, 28 January 2012
 * @version     $Id: Ean13.php 36 2012-01-28 18:45:35Z mail@henryhayes.co.uk $
 */
class YinYang_Filter_Barcode_Ean13Test extends PHPUnit_Framework_TestCase
{
    /**
     * This test ensures that the value is correctly filtered.
     *
     * @dataProvider provider
     */
    public function testFilterBarcode($value, $expected)
    {
        $filter = new YinYang_Filter_Barcode_Ean13();
        $this->assertInstanceOf('YinYang_Filter_Barcode_Ean13', $filter);

        $this->assertSame($expected, $filter->filter($value));
    }

    /**
     * This is a data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('', null), // Empty
            array('0', null), // Empty
            array(' ', null), // Empty
            array('NOT-NUMERIC', null),
            array('77676656', null), // Invalid EAN8 - we do not validated EAN8 at this time.
            array('123456789999', '0123456789999'), // Upc valid, translated to EAN
            array('5031366016409', '5031366016409'),
            array('99802618537', '0099802618537'),
            array('99802469443', '0099802469443'),
            array('58231298109', '0058231298109'), // Too short but valid ean, needs zeros padding.

        );
    }
}