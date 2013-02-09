<?php
class YinYang_Filter_Word_UnderscoreToLowerCamelCase_UnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test instatiates a YinYang_Filter_Word_UnderscoreToLowerCamelCase
     * instance and runs the tests from the data provider below.
     *
     * @dataProvider provider
     */
    public function testYinYangFilterWordUnderscoreToLowerCamelCase($value, $result)
    {
        $obj = new YinYang_Filter_Word_UnderscoreToLowerCamelCase();

        $this->assertSame($result, $obj->filter($value));
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('underscore_name', 'underscoreName',),
            array('Upper_Underscore_Name', 'upperUnderscoreName'),
        );
    }
}