<?php
/**
 * Unit test for the Validate Url class.
 *
 * @category    YinYang
 * @package     YinYang_Validate_Url
 * @subpackage  UnitTest
 * @since       Monday, 06 June 2011
 * @version     $Id: Url.test.php 25 2011-11-14 14:31:19Z mail@henryhayes.co.uk $
 */
class YinYang_Validate_UrlTest extends PHPUnit_Framework_TestCase
{
    /**
     * This test instatiates a YinYang_Validate_Url instance
     * and runs the tests from the data provider below.
     *
     * @dataProvider provider
     */
    public function testYinYangValidateUrl($value, $success, $error = null)
    {
        $obj = new YinYang_Validate_Url();
        $obj->setDisableTranslator(true);

        if (true === $success) {
            $this->assertTrue($obj->isValid($value));
        } else {
            $this->assertFalse($obj->isValid($value));
            // On failure, as this is a validator, we also test our validation messages.
            $this->assertEquals(reset(array_keys($obj->getMessages())), $error);
        }
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            array('http://www.google.com', true),
            array('https://www.google.com', true),
            array('ftp://uploads.google.com', true),
            array('shttp://www.google.com', false, YinYang_Validate_Url::INVALID_SCHEME),
            array('sftp://uploads.google.com', false, YinYang_Validate_Url::INVALID_SCHEME),
            array('http://uploads^&.google.com', false, YinYang_Validate_Url::INVALID_SYNTAX),
            array('http://this-hostname-does-not-exist213595231.com', false, YinYang_Validate_Url::INVALID_HOSTNAME),
        );
    }
}