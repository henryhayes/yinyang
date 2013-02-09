<?php
/**
 * Limits the amount of words in a given string. Words are
 * delimited by a whitespace character.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  SentenceLength
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: SentenceLength.php 20 2011-10-26 22:07:08Z mail@henryhayes.co.uk $
 * @since       Sunday, 05 June 2011
 */

/**
 * Limits the amount of words in a given string. Words are
 * delimited by a whitespace character.
 *
 * This class works exactly like Google's meta title filter. It counts the
 * amount of characters in total in the string including all whitespaces,
 * then truncates to the end of the last word before the maximum string length.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  SentenceLength
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Sunday, 05 June 2011
*/
class YinYang_Filter_SentenceLength implements Zend_Filter_Interface
{
    /**
     * The entire string length must not exceed this value.
     *
     * @var int
     */
    protected $_maxLength = 128;

    /**
     * Whether to add Ellipsis to string if it is shortened.
     *
     * @var bool
     */
    protected $_addEllipsis = false;

    /**
     * Whether multiple whitespaces should be removed, default to true.
     *
     * @var bool
     */
    protected $_replaceMultipleWhitespace = true;

    /**
     * Sets filter options
     *
     * @param int $maxLength  [optional] defaults to 128
     * @param bool $addEllipsis [optional] whether ellipsis should be appended to the shortened string
     * @param bool $replaceWhitespace [optional] whether repeated whitespace
     *                                should be removed, default is true
     * @return void
     */
    public function __construct($maxLength = null, $addEllipsis = false, $replaceWhitespace = null)
    {
        if (is_integer($maxLength) && $maxLength > 0) {
            $this->_maxLength = $maxLength;
        }

        if (true === $addEllipsis) {
            $this->_addEllipsis = $addEllipsis;
        }

        if (is_bool($replaceWhitespace)) {
            $this->_replaceMultipleWhitespace = $replaceWhitespace;
        }
    }

    /**
     * Returns the filtered string of $value
     *
     * @param  string $value
     * @return string
     */
    public function filter($value)
    {
        $value = trim((string) $value);

        if ($this->_replaceMultipleWhitespace) {

            $value = @preg_replace('/\s+/', ' ', $value);
        }

        if (strlen($value) > $this->_maxLength) {
            $arr = explode(' ', $value);

            if ($arr !== false) {
                $value = $arr[0];
                $count = count($arr);
                if ($count > 1) {
                    for ($i = 1; $i < $count; $i++) {
                        if ((strlen($value) + strlen($arr[$i]) + 1)
                            > $this->_maxLength) {
                            break;
                        } else {
                            $value .= " {$arr[$i]}";
                        }
                    }
                }
            }

            $value = substr($value, 0, $this->_maxLength);

            if (true === $this->_addEllipsis) {

                $value .= '…';
            }
        }

        return $value;
    }
}