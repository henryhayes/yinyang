<?php
/**
 * Unit test for the YinYang_Filter_Url_Slug class.
 *
 * @category    YinYang
 * @package     Controller_Router_Route_PosKey
 * @subpackage  UnitTest
 * @since       Thursday, 08 March 2012
 * @version     $Id: PosKey.test.php 39 2012-03-11 22:08:52Z mail@henryhayes.co.uk $
 */
class YinYang_Controller_Router_Route_PosKeyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test for the match() method.
     *
     * @dataProvider provider
     */
    public function testMatch(array $info, $matchPath, $returnVars)
    {
        $config = new Zend_Config($info);

        $route = YinYang_Controller_Router_Route_PosKey::getInstance($config);
        $this->assertInstanceOf('YinYang_Controller_Router_Route_PosKey', $route);

        $this->assertEquals($returnVars, $route->match($matchPath));
        $this->assertEquals(trim($matchPath, '/'), $route->assemble($returnVars, false, false));

        // Version
        $this->assertEquals('1', $route->getVersion());
    }

    /**
     * This is the data provider for the above Unit-test.
     */
    public function provider()
    {
        return array(
            // Basic positonal and named route.
            array(
                array(
                    'route'=>'/stem-name/',
                    'positional' => array(
                        0 => 'pos1',
                        1 => 'pos2',
                    ),
                    'named' => array(
                        0 => 'namedOneName',
                        1 => 'NamedTwoName',
                        2 => 'page',
                    ),
                    'reqs' => array(
                        'pos1'         => '[A-Za-z0-9-]+',
                        'pos2'         => '[A-Za-z0-9]+',
                        'namedOneName' => '[A-Za-z]+',
                        'NamedTwoName' => '[A-Za-z]+',
                        'page'         => '\d+',
                    ),
                ),
                '/stem-name/pos1-value/pos2value/namedOneName/NamedOneValue/NamedTwoName/NamedTwoValue/page/12',
                array(
                    'pos1'         => 'pos1-value',
                    'pos2'         => 'pos2value',
                    'namedOneName' => 'NamedOneValue',
                    'NamedTwoName' => 'NamedTwoValue',
                    'page'         => '12',
                )
            ),
        );
    }
}