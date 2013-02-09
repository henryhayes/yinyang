<?php

/**
 * Unit test for the YinYang_Filter_Keywords class.
 *
 * @category    YinYang
 * @package     YinYang_Filter_Keywords
 * @subpackage  UnitTest
 * @since       Sunday, 05 June 2011
 * @version     $Id: BrowscapTest.php 50 2012-06-13 15:42:37Z mail@henryhayes.co.uk $
 */
class YinYang_Http_UserAgent_Features_Adapter_BrowscapTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        //ini_set('browscap', '/my/temp/browscap.ini');
        $browscap = ini_get('browscap');
        //die($browscap);
        if (empty($browscap) || !file_exists($browscap)) {
            //$this->markTestSkipped('Requires php.ini to provide a valid "browscap" entry');
        }
    }

    /**
     * Unit test for YinYang_Http_UserAgent_Features_Adapter_Browscap::testGetFromRequest
     *
     * @dataProvider dataProvider
     */
    public function testGetFromRequest($userAgentString, array $params)
    {
        $request = array();
        $request['http_user_agent'] = $userAgentString;
        $adapter = YinYang_Http_UserAgent_Features_Adapter_Browscap::getFromRequest($request, array());
        //print_r($adapter);
        foreach ($params as $name => $value) {
            $this->assertEquals($value, $adapter[$name]);
        }
    }

    /**
     * Data provider for testGetFromRequest().
     */
    public function dataProvider()
    {
        return array(
            // Generic iPhone
            array(
                'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) ' .
                    'Version/3.0 Mobile/4A102 Safari/419.3',
                array(
                    'ismobiledevice' => '1',
                    'javascript' => '1',
                    'cssversion' => '3',
                    'device_name' => 'iPhone',
                    'mobile_browser' => 'Safari',
                    'device_os' => 'iOS',
                )
            ),

            // Generic iPad
            array(
                'Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 ' .
                    '(KHTML, like Gecko) Mobile/*',
                array(
                    'ismobiledevice' => '1',
                    'javascript' => '1',
                    'cssversion' => '3',
                    'device_name' => 'iPad',
                    'mobile_browser' => 'Safari',
                    'device_os' => 'iOS',
                )
            ),

            // MS IE 9 Windows 7 x64
            array(
                'Mozilla/5.0 (compatible; MSIE 9.0; *Windows NT 6.1; WOW64; Trident/5.0*)*',
                array(
                    'ismobiledevice' => '',
                    'javascript' => '1',
                    'cssversion' => '3',
                    'device_name' => 'PC',
                    'mobile_browser' => 'IE',
                    'device_os' => 'Win7',
                    'win64' => '1',
                )
            ),

            // Linux Firefox 13.0
            array(
                'Mozilla/5.0 (*Linux*) Gecko/* Firefox/13.*',
                array(
                    'ismobiledevice' => '',
                    'javascript' => '1',
                    'cssversion' => '3',
                    'device_name' => 'PC',
                    'mobile_browser' => 'Firefox',
                    'device_os' => 'Linux',
                )
            ),
        );
    }
}
