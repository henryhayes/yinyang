<?php
/**
 * Filters a list of keywords into a comma separated keywords.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Keywords
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Keywords.php 14 2011-06-28 10:04:45Z mail@henryhayes.co.uk $
 * @since       Tuesday, 28 June 2011
 */

/**
 * Filters a list of keywords into a comma separated keywords.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Keywords
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Tuesday, 28 June 2011
*/
class YinYang_Filter_Keywords implements Zend_Filter_Interface
{
    public function filter($string)
    {
        $string = trim(trim($string), ',');

        $string = preg_replace('/,\s+/', ',', $string);

        return strtolower($string);
    }
}