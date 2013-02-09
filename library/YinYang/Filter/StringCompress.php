<?php
/**
 * Compress a string using gzcompress.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  StringCompress
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: StringCompress.php 6 2011-06-05 16:17:11Z pricespin.craig $
 * @since       Sunday, 05 June 2011
 */

/**
 * Compress a string using gzcompress.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  StringCompress
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Sunday, 05 June 2011
*/
class YinYang_Filter_StringCompress implements Zend_Filter_Interface
{
    /**
     * Returns a compressed string.
     *
     * @param   string  $str    The string to be filtered.
     */
    public function filter($string)
    {
        return strtr(base64_encode(addslashes(gzcompress($string, 9))), '+/=', '-_~');
    }
}