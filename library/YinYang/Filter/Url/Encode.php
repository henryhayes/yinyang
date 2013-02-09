<?php
/**
 * Url encodes a string.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Url_Encode
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Encode.php 46 2012-04-22 16:01:04Z mail@henryhayes.co.uk $
 * @since       Sunday, 22 April 2012
 */

/**
 * Url encodes a string.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Url_Encode
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Sunday, 22 April 2012
*/
class YinYang_Filter_Url_Encode implements Zend_Filter_Interface
{
    /**
     * Url encodes a string.
     *
     * @param   string  $string The string to be filtered.
     * @return  string
     */
    public function filter($string)
    {
        return urlencode($string);
    }
}