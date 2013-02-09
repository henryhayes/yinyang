<?php
/**
 * A view helper for displaying / formatting the date and or time.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_DateTime
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: DateTime.php 48 2012-05-28 14:16:25Z mail@henryhayes.co.uk $
 * @since       Monday, 28 May 2012
 */

/**
 * A view helper for displaying / formatting the date and or time.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_DateTime
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_View_Helper_DateTime extends Zend_View_Helper_Abstract
{
    /**
     * Returns the date format as specified in the $format param.
     *
     * @param string | DateTime $dateTime
     * @param string $format
     */
    public function dateTime($dateTime = null, $format = null)
    {
        if (is_null($dateTime)) {
            return $this;
        }

        return $this->format($dateTime, $format);
    }

    /**
     * Returns the date format as specified in the $format param.
     *
     * @param string | DateTime $dateTime
     * @param string $format
     */
    public function format($dateTime, $format = null)
    {
        if (is_null($format)) {
            $format = DATE_ISO8601;
        }

        if ($dateTime instanceof DateTime) {
            return $dateTime->format($format);
        }

        return date($format, strtotime($dateTime));
    }
}