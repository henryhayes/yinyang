<?php
/**
 * Decompress a string that has bee compressed
 * using YinYang_Filter_StringCompress
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  StringDecompress
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: StringDecompress.php 6 2011-06-05 16:17:11Z pricespin.craig $
 * @since       Sunday, 05 June 2011
 */

/**
 * Decompress a string that has bee compressed
 * using YinYang_Filter_StringCompress
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  StringDecompress
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Sunday, 05 June 2011
*/
class YinYang_Filter_StringDecompress implements Zend_Filter_Interface
{
    /**
     * Returns a decompressed string created by YinYang_Filter_StringCompress.
     *
     * @param   string  $str    The string to be filtered.
     */
    public function filter($string)
    {
        return gzuncompress(stripslashes(base64_decode(strtr($string, '-_~', '+/='))));
    }
}