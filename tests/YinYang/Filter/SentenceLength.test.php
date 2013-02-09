<?php
/**
 * Unit test for the YinYang_Filter_SentenceLength class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_SentenceLength
 * @subpackage  UnitTest
 * @since       Sunday, 05 June 2011
 * @version     $Id: SentenceLength.test.php 25 2011-11-14 14:31:19Z mail@henryhayes.co.uk $
 */
class YinYang_Filter_SentenceLengthTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test instatiates a YinYang_Filter_Url_Slug instance
     * and runs the tests from the data provider below.
     *
     * @dataProvider provider
     */
    public function testYinYangFilterSentenceLength($value, $result, $maxLength, $addEllipsis = false, $replace = false)
    {
        $obj = new YinYang_Filter_SentenceLength($maxLength, $addEllipsis, $replace);

        $this->assertSame($result, $obj->filter($value));
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('One Two Three Four Five Six Seven Eight',
                'One Two Three Four Five Six Seven Eight', 128, false),
            array('One, two three, four five',
                'One, two three, four', 20, false),
            array('One two three four five',
                'One two three four', 20, false),
            array('One two, three three2, five',
                'One two, three three2, five', 27, false),
            // Extra spaces test
            array('One  two,  three  three2,  five',
                'One  two,  three  three2,  five', 40, false, false),
            // Extra spaces test
            array('One  two,  three  three2,  five',
                'One two, three three2, five', 27, false, true),
            // Google meta title test
            array(
                'Remarks on the Quantum-Gravity effects of "Bean ' .
                'Pole" diversification in Mononucleosis patients in Developing ' .
                'Countries under Economic Conditions Prevalent during ' .
                'the Second half of the Twentieth Century, and Related Papers: ' .
                'a Summary',
                'Remarks on the Quantum-Gravity effects of "Bean Pole" diversification',
                70, false
            ),
            // Google meta title test
            array(
                'Remarks on the Quantum-Gravity effects of "Bean ' .
                'Pole" diversification in Mononucleosis patients in Developing ' .
                'Countries under Economic Conditions Prevalent during ' .
                'the Second half of the Twentieth Century, and Related Papers: ' .
                'a Summary',
                'Remarks on the Quantum-Gravity effects of "Bean Pole" diversification…',
                70,
                true, true
            ),
        );
    }
}