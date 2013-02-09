<?php
/**
 * Filters a EAN8 or UPC barcode and turns it into a EAN13 barcode.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Barcode_Ean13
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Ean13.php 36 2012-01-28 18:45:35Z mail@henryhayes.co.uk $
 * @since       Saturday, 28 January 2012
 */

/**
 * Filters a EAN8 or UPC barcode and turns it into a EAN13 barcode.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Barcode_Ean13
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Saturday, 28 January 2012
*/
class YinYang_Filter_Barcode_Ean13 implements Zend_Filter_Interface
{
    /**
     * Returns the result of filtering $value
     *
     * @param  mixed $value
     * @throws Zend_Filter_Exception If filtering $value is impossible
     * @return mixed
     */
    public function filter($value)
    {
        $value = trim((string)$value);

        if (empty($value)) {
            return null;
        }

        if (!is_numeric($value)) {
            return null;
        }

        // In this scenario, the leading zeros may have been chopped off
        // by an excel type program.
        $length = strlen($value);
        if ($length > 8 && $length < 12) {
            $result = str_pad($value, 13, '0', STR_PAD_LEFT);
            return $result;
        }

        // Upc? - create EAN
        if (12 == strlen($value)) {
            $validator = new Zend_Validate_Barcode('Upca');
            if ($validator->isValid($value)) {
                $value = str_pad($value, 13, '0', STR_PAD_LEFT);
            }
        }

        if (13 == strlen($value)) {
            $validator = new Zend_Validate_Barcode('Ean13');
            if ($validator->isValid($value)) {
                return $value;
            }
        }

        return null;
    }
}