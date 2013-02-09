<?php
/**
 * Unit test for the YinYang_Filter_Url_Slug class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_Url_Slug
 * @subpackage  UnitTest
 * @since       Saturday, 04 June 2011
 * @version     $Id: Slug.test.php 3 2011-06-05 11:21:23Z pricespin.craig $
 */
class YinYang_Filter_Url_Slug_UnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test instatiates a YinYang_Filter_Url_Slug instance
     * and runs the tests from the data provider below.
     *
     * @dataProvider provider
     */
    public function testYinYangFilterUrlSlug($value, $result)
    {
        $obj = new YinYang_Filter_Url_Slug();

        $this->assertEquals($result, $obj->filter($value));
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('One Two Three Four Five Six Seven Eight',
                'one-two-three-four-five-six-seven-eight'),
            array('One Two Three Four Five Six Seven Eight And',
                'one-two-three-four-five-six-seven-eight'),
            array('Solar Panels', 'solar-panels'),
            array('Solar Panels & Solar Equipment', 'solar-panels-and-solar-equipment'),
            // added retrospectively as a fix
            array('audio-visual-products', 'audio-visual-products'),
            array('Audio-Visual-Products-Uppercase', 'audio-visual-products-uppercase'),
        );
    }
}