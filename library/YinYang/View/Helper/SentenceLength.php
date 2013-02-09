<?php
/**
 * A view helper that implements the SentenceLength filter.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_SentenceLength
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: SentenceLength.php 20 2011-10-26 22:07:08Z mail@henryhayes.co.uk $
 * @since       Monday, 06 June 2011
 */

/**
 * A view helper that implements the SentenceLength filter.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_SentenceLength
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_View_Helper_SentenceLength extends Zend_View_Helper_Abstract
{
    /**
     * Wraps around the sentence length filter, limits the length of
     * a sentence based on the $length variable.
     *
     * @param string $string
     * @param boolean|null $length
     * @param boolean|null $whitespace
     */
    public function sentenceLength($string, $length = null, $addEllipsis = false, $whitespace = null)
    {
        $obj = new YinYang_Filter_SentenceLength($length, $addEllipsis, $whitespace);

        return $obj = $obj->filter($string);
    }
}