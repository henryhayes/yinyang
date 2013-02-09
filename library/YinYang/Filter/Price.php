<?php
/**
 * Filters a price to just return digits and a decimal point.
 *
 * @category    YinYang
 * @package     YinYang_Price
 * @subpackage  Keywords
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Price.php 34 2012-01-28 18:24:22Z mail@henryhayes.co.uk $
 * @since       Saturday 28 January 2012
 */

/**
 * Filters a price to just return digits and a decimal point.
 *
 * @category    YinYang
 * @package     YinYang_Price
 * @subpackage  Keywords
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Saturday 28 January 2012
*/
class YinYang_Filter_Price extends Zend_Filter_PregReplace
{
    /**
     * Contains the regula expression pattern to match against.
     * @var string
     */
    protected $_matchPattern = '/[^0-9\.]+/';

    /**
     * Contains the replacement string. In this instance, single white space.
     * @var string
     */
    protected $_replacement = '';

    /**
     * Perform regexp replacement as filter. Needs to be Euro compatible,
     * so added the replacement of the comma for the decimal point.
     *
     * @param  string $value
     * @return string
     */
    public function filter($value)
    {
        // One does not separate thousands using a comma in the Eurozone,
        // so there should only ever be a comma separating the decimal points.
        if ((',' == substr($value, -3, 1)) && (1 == substr_count($value, ','))) {
            $value = str_replace(',', '.', $value);
        }

        return parent::filter($value);
    }
}