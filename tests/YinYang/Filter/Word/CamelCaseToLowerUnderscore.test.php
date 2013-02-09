<?php
class YinYang_Filter_Word_CamelCaseToLowerUnderscore_UnitTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test instatiates a YinYang_Filter_Word_CamelCaseToLowerUnderscore
     * instance and runs the tests from the data provider below.
     *
     * @dataProvider provider
     */
    public function testYinYangFilterWordCamelCaseToLowerUnderscore($value, $result)
    {
        $obj = new YinYang_Filter_Word_CamelCaseToLowerUnderscore();

        $this->assertSame($result, $obj->filter($value));
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('CamelCaseToUnderscore', 'camel_case_to_underscore'),
            array('lowerCamelCase', 'lower_camel_case'),
        );
    }
}