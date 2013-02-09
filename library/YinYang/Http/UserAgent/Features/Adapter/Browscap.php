<?php
/**
 * Browser Capabilities Project class file.
 *
 * @category    YinYang
 * @package     YinYang_Http
 * @subpackage  UserAgent_Features_Adapter_Browscap
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Browscap.php 50 2012-06-13 15:42:37Z mail@henryhayes.co.uk $
 * @since       Wednesday 13th June 2012
 */

/**
 * This is an implementation of the Browser Capabilities Project
 * which enables the get_browser() function in a standard php installation.
 *
 * It should be noted that this is code taken from the proposed Zend Framework implementaion. We are implementing
 * it here as this is not yet in production and is due to be release under ZF version 1.12. After this
 * releaase, this class will simply inherit from the Zend Framework counterpart.
 *
 * @link    http://browsers.garykeith.com/
 * @link    http://php.net/get_browser
 * @link    http://framework.zend.com/svn/framework/standard/trunk/
 *              library/Zend/Http/UserAgent/Features/Adapter/Browscap.php
 * @see     Zend_Http_UserAgent_Features_Adapter_Browscap
 *
 * @category    YinYang
 * @package     YinYang_Http
 * @subpackage  UserAgent_Features_Adapter_Browscap
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_Http_UserAgent_Features_Adapter_Browscap implements Zend_Http_UserAgent_Features_Adapter
{
    /**
     * Constructor
     *
     * Validate that we have browscap support available.
     *
     * @return void
     * @throws Zend_Http_UserAgent_Features_Exception
     */
    public function __construct()
    {
        $browscap = ini_get('browscap');
        if (empty($browscap) || !file_exists($browscap)) {
            require_once 'Zend/Http/UserAgent/Features/Exception.php';
            throw new Zend_Http_UserAgent_Features_Exception(
                sprintf(
                    '%s requires a browscap entry in php.ini pointing to a valid browscap.ini; none present',
                    __CLASS__
                )
            );
        }
    }

    /**
     * Get features from request
     *
     * @param  array $request $_SERVER variable
     * @param  array $config ignored; included only to satisfy parent class
     * @return array
     */
    public static function getFromRequest($request, array $config)
    {
        $browscap = get_browser($request['http_user_agent'], true);
        $features = array();
        foreach ($browscap as $key => $value) {
            // For a few keys, we need to munge a bit for the device object
            switch ($key) {
                case 'browser':
                    $features['mobile_browser'] = $value;
                    break;
                case 'version':
                    $features['mobile_browser_version'] = $value;
                    break;
                case 'platform':
                    $features['device_os'] = $value;
                    break;
                default:
                    $features[$key] = $value;
                    break;
            }
        }
        return $features;
    }
}