<?php
/**
 * This class replaces multiple whitespaces with one whitespace.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  MultipleWhitespace
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: MultipleWhitespace.php 16 2011-10-13 09:04:40Z mail@henryhayes.co.uk $
 * @since       Thursday, 13 October 2011
 */

/**
 * This class replaces multiple whitespaces with one whitespace.
 *
 * When a string contains multiple instaces of a whitespace character, this
 * class replaces all those instances with a single instance of a whitespace.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  MultipleWhitespace
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Thursday, 13 October 2011
*/
class YinYang_Filter_MultipleWhitespace extends Zend_Filter_PregReplace
{
    /**
     * Contains the regula expression pattern to match against.
     * @var string
     */
    protected $_matchPattern = '/\s+/';

    /**
     * Contains the replacement string. In this instance, single white space.
     * @var string
     */
    protected $_replacement = ' ';
}